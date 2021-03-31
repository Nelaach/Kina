<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Film_formular;
use App\Models\Sal_formular;

class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);


		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))
											->first();

				$this->setUserSession($user);
				//$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('dashboard');

			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function register(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/');

			}
		}


		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}

	public function profile(){
		
		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				];

			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}


			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

				$newData = [
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
					];
					if($this->request->getPost('password') != ''){
						$newData['password'] = $this->request->getPost('password');
					}
				$model->save($newData);

				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');

			}
		}

		$data['user'] = $model->where('id', session()->get('id'))->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

	//--------------------------------------------------------------------
	public function uvodni(){
		echo view('templates/header');
		echo view('frontend/uvodni');
		echo view('templates/footer');
	}
	
	public function film() {
		if (session()->get('isLoggedIn')) {
		echo view('templates/header');
		echo view('film_formular');
		echo view('templates/footer');
	}
	else {
		echo view('templates/header');
		?><style>.center {text-align: center;color: red;}</style><?php
		echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
		echo view('templates/footer');

	}
	}
	public function form() {
		if (session()->get('isLoggedIn')) { 
		$data = [ 'cesky_nazev' =>$this->request->getVar('cesky_nazev'),
		'originalni_nazev' =>$this->request->getVar('originalni_nazev'),
		'delka_filmu' =>$this->request->getVar('delka_filmu'),
		'typ_filmu' =>$this->request->getVar('typ_filmu'),
		'zeme_idZeme' =>$this->request->getVar('zeme_idZeme'),
		'zanrFilmu_idZanrFilmu' =>$this->request->getVar('zanrFilmu_idZanrFilmu'),
		'promitani_idPromitani' =>$this->request->getVar('promitani_idPromitani'),
		'jazyky_idJazyky' =>$this->request->getVar('jazyky_idJazyky') ];

		
		/*
		$db =  \Config \Database::connect();
		$builder = $db->table('film');
		$builder->insert($data); */

		$model = new Film_formular();
		
		if ($model->insert($data))
		{
			echo view('templates/header');
			?><style>.center {text-align: center;color: red;}</style><?php
			echo "<h3 class='center'>Úspěšně přidáno</h3>";
			echo view('film_formular');
			echo view('templates/footer');
		}
		else 
		{
			echo "nepřidáno";
		}
	}
	else {
		echo view('templates/header');
		?><style>.center {text-align: center;color: red;}</style><?php
		echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
		echo view('templates/footer');

	}

	}

		public function prehled_filmu() 
		{
			if (session()->get('isLoggedIn')) { 
			echo view('templates/header');
			echo view('prehled_filmu');
			echo view('templates/footer');
		}
		else {
			echo view('templates/header');
			?><style>.center {text-align: center;color: red;}</style><?php
			echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
			echo view('templates/footer');
	
		}
	
		}
		public function smazat($id)
		{
			if (session()->get('isLoggedIn')) {
			$db = \Config\Database::connect(); 
			$builder = $db->table('film');
			$builder->delete(['idFilm' => $id]);

			echo view('templates/header');
			?><style>.center {text-align: center;color: grey;}</style><?php
			echo "<h3 class='center'>Úspěšně Smazáno</h3>";
			echo view('prehled_filmu');
			echo view('templates/footer');
			}
			else {
				echo view('templates/header');
				?><style>.center {text-align: center;color: red;}</style><?php
				echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
				echo view('templates/footer');
		
			}
		
		}

			public function konkretni($id)
			{
				if (session()->get('isLoggedIn')) {
				$db = \Config\Database::connect(); 

				$data['query'] = $db->query('SELECT * FROM film where idFilm="' . $id . '"');
				

				echo view('templates/header');
				echo view('konkretni', $data);
				echo view('templates/footer');
				}
				else {
					echo view('templates/header');
					?><style>.center {text-align: center;color: red;}</style><?php
					echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
					echo view('templates/footer');
			
				}
			
			}
			public function update($id)	
			{
				if (session()->get('isLoggedIn')) {
					$data = [
						'idFilm' => $id,
						'cesky_nazev' =>$this->request->getVar('cesky_nazev'),
					'originalni_nazev' =>$this->request->getVar('originalni_nazev'),
					'delka_filmu' =>$this->request->getVar('delka_filmu'),
					'typ_filmu' =>$this->request->getVar('typ_filmu'),
					'zeme_idZeme' =>$this->request->getVar('zeme_idZeme'),
					'zanrFilmu_idZanrFilmu' =>$this->request->getVar('zanrFilmu_idZanrFilmu'),
					'promitani_idPromitani' =>$this->request->getVar('promitani_idPromitani'),
					'jazyky_idJazyky' =>$this->request->getVar('jazyky_idJazyky') ];
			
					
				
					$model = new Film_formular();
					if ($model->save($data))
					{
						echo view('templates/header');
						?><style>.center {text-align: center;color: red;}</style><?php
						echo "<h3 class='center'>Úspěšně změněno</h3>";
						echo view('prehled_filmu');
						echo view('templates/footer');
					}
					else 
					{
						echo "nepřidáno";
					}			

				}
				else {
					echo view('templates/header');
					?><style>.center {text-align: center;color: red;}</style><?php
					echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
					echo view('templates/footer');
			
				}
			
			}
			public function vstupenky() 
			{
				if (session()->get('isLoggedIn')) { 
				echo view('templates/header');
				echo view('vstupenky');
				echo view('templates/footer');
			}
			else {
				echo view('templates/header');
				?><style>.center {text-align: center;color: red;}</style><?php
				echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
				echo view('templates/footer');
		
			}
	
		}
		public function novySal() {
			if (session()->get('isLoggedIn')) { 
			$data = [ 'nazev' =>$this->request->getVar('nazev'),
			'kapacita' =>$this->request->getVar('kapacita'),
			'3D' =>$this->request->getVar('3D'),
			'prostorovyZvuk' =>$this->request->getVar('prostorovyZvuk')];
	
			$model = new Sal_formular();
			
			if ($model->insert($data))
			{
				echo view('templates/header');
				?><style>.center {text-align: center;color: red;}</style><?php
				echo "<h3 class='center'>Úspěšně přidáno</h3>";
				echo view('film_formular');
				echo view('templates/footer');
			}
			else 
			{
				echo "nepřidáno";
			}
		}
		else {
			echo view('templates/header');
			?><style>.center {text-align: center;color: red;}</style><?php
			echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
			echo view('templates/footer');
	
		}
	
		}
		public function sal() {
			if (session()->get('isLoggedIn')) {
			echo view('templates/header');
			echo view('sal');
			echo view('templates/footer');
		}
		else {
			echo view('templates/header');
			?><style>.center {text-align: center;color: red;}</style><?php
			echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
			echo view('templates/footer');
	
		}
	
	}
	public function prehled_salu() 
	{
		if (session()->get('isLoggedIn')) { 
		echo view('templates/header');
		echo view('prehled_salu');
		echo view('templates/footer');
	}
	else {
		echo view('templates/header');
		?><style>.center {text-align: center;color: red;}</style><?php
		echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
		echo view('templates/footer');

	}

	}
	public function smazat_sal($id)
	{
		if (session()->get('isLoggedIn')) {
		$db = \Config\Database::connect(); 
		$builder = $db->table('sal');
		$builder->delete(['idSal' => $id]);

		echo view('templates/header');
		?><style>.center {text-align: center;color: grey;}</style><?php
		echo "<h3 class='center'>Úspěšně Smazáno</h3>";
		echo view('prehled_salu');
		echo view('templates/footer');
		}
		else {
			echo view('templates/header');
			?><style>.center {text-align: center;color: red;}</style><?php
			echo "<h3 class='center'>Bez přihlášení se sem nedostaneš</h3>";
			echo view('templates/footer');
	
		}
	
	}

	}
		
	
	



