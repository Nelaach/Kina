
<!DOCTYPE html>
<html>

    <head> 
        <title>Úprava filmu </title> 
        <?php $db = \Config\Database::connect(); ?>
        <style>
      html, body {
      height: 100%;
      }
      body, input, select { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #eee;
      }
      h1, h3 {
      font-weight: 400;
      }
      h1 {
      font-size: 32px;
      }
      h3 {
      color: #1c87c9;
      }
      .main-block, .info {
      display: flex;
      flex-direction: column;
      }
      .main-block {
      justify-content: center;
      align-items: center;
      width: 100%; 
      min-height: 100%;
      background: url("/uploads/media/default/0001/01/e7a97bd9b2d25886cc7b9115de83b6b28b73b90b.jpeg") no-repeat center;
      background-size: cover;
      }
      form {
      width: 80%; 
      padding: 80px;
      margin-bottom: 200px;
      background: grey;
      }
      input, select {
      padding: 5px;
      margin-bottom: 20px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #eee;
      }
      input::placeholder {
      color: #eee;
      }
      option {
      background: black; 
      border: none;
      }
      .metod {
      display: flex; 
      }
      input[type=radio] {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin-right: 20px;
      text-indent: 32px;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: -1px;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 8px;
      height: 4px;
      top: 5px;
      left: 5px;
      border-bottom: 3px solid #1c87c9;
      border-left: 3px solid #1c87c9;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      button {
      display: block;
      width: 200px;
      padding: 10px;
      margin: 20px auto 0;
      border: none;
      border-radius: 5px; 
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #095484;
      }
      @media (min-width: 568px) {
      .info {
      flex-flow: row wrap;
      justify-content: space-between;
      }
      input {
      width: 46%;
      }
      input.fname {
      width: 100%;
      }
      .zvyrazneni {
  background-color: yellow;
}

    </style>        
    </head>
    <body>


  <?php 
  $results = $query->getResultArray();
  foreach ($results as $row) { 
    $idFilm = $row['idFilm']; 
   $cesky_nazev = $row['cesky_nazev']; 
   $originalni_nazev = $row['originalni_nazev']; 
   $delka_filmu = $row['delka_filmu']; 
   $typ_filmu = $row['typ_filmu']; 
   $zanrFilmu_idZanrFilmu = $row['zanrFilmu_idZanrFilmu'];
   $promitani_idPromitani = $row['promitani_idPromitani']; 
   $jazyky_idJazyky = $row['jazyky_idJazyky']; 
   //$shodne = $db->query('SELECT zeme.nazev as nazev, zeme.idZeme as idZeme FROM zeme INNER JOIN film ON film.zeme_idZeme=zeme.idZeme where film.idFilm ="' . $idFilm . '"');

 } ?>

<div class="main-block">
      <h1>Přepsat film</h1>
	  <form method="post" action="<?php echo base_url('Users/update/'.$idFilm) ?>">
        <div class="info">
          <input type="text" name="cesky_nazev" required="vyžadováno" placeholder="Český název filmu" value="<?php echo $cesky_nazev ?>">
          <input type="text" name="originalni_nazev" required="vyžadováno" placeholder="Původní název filmu" value="<?php echo $originalni_nazev ?>">
          <input type="number" name="delka_filmu" required="vyžadováno" placeholder="Délka filmu" value="<?php echo $delka_filmu ?>">
          <input type="text" name="typ_filmu" required="vyžadováno" placeholder="Typ filmu" value="<?php echo $typ_filmu ?>">
          <select class="form-control" name="zeme_idZeme" id="zeme_idZeme">
            <?php
            $query = $db->query("SELECT * FROM zeme");
            $shodne = $db->query('SELECT zeme.nazev as nazev, zeme.idZeme as idZeme FROM zeme INNER JOIN film ON film.zeme_idZeme=zeme.idZeme where film.idFilm ="' . $idFilm . '"');
            if ($shodne) {
              foreach ($shodne->getResult() as $row)
              {
                 ?> 
           <option class="zvyrazneni" value=<?php echo $row->idZeme?>, selected> <?php echo $row->nazev;?></option>
            <?php }}
            foreach ($query->getResult() as $row)
            { ?> 
         <option value=<?php echo $row->idZeme?>> <?php echo $row->nazev;?></option>
         <?php } ?>
          </select>

          <select class="form-control" name="zanrFilmu_idZanrFilmu" id="zanrFilmu_idZanrFilmu">
            <?php
            $query = $db->query("SELECT * FROM zanrFilmu");
            $shodne = $db->query('SELECT zanrFilmucol as nazev, idZanrFilmu as id FROM zanrFilmu INNER JOIN film ON film.zanrFilmu_idZanrFilmu=idZanrFilmu where film.idFilm ="' . $idFilm . '"');
            if ($shodne) {
              foreach ($shodne->getResult() as $row)
              {
                 ?> 
           <option class="zvyrazneni" value=<?php echo $row->id?>, selected> <?php echo $row->nazev;?></option>
            <?php }}
            
            foreach ($query->getResult() as $row)
            { ?> 
            
         <option value=<?php echo $row->idZanrFilmu?>> <?php echo $row->zanrFilmucol;}?></option>
          </select>

          <select class="form-control" name="promitani_idPromitani" id="promitani_idPromitani">
            <?php
            $query = $db->query("SELECT * FROM promitani");
            $shodne = $db->query('SELECT promitani.datum as nazev, promitani.idPromitani as id FROM promitani INNER JOIN film ON film.promitani_idPromitani=promitani.idPromitani where film.idFilm ="' . $idFilm . '"');
            if ($shodne) {
              foreach ($shodne->getResult() as $row)
              {
                 ?> 
           <option class="zvyrazneni" value=<?php echo $row->id?>, selected> <?php echo $row->nazev;?></option>
            <?php }}
             
            foreach ($query->getResult() as $row)
            { ?> 
         <option value=<?php echo $row->idPromitani?>> <?php echo $row->datum;}?></option>
          </select>
         
          <select class="form-control" name="jazyky_idJazyky" id="jazyky_idJazyky">
            <?php
            $query = $db->query("SELECT * FROM jazyky");
            $shodne = $db->query('SELECT jazyky.nazev as nazev, idJazyky as id FROM Jazyky INNER JOIN film ON film.jazyky_idJazyky=idJazyky where film.idFilm ="' . $idFilm . '"');
            if ($shodne) {
              foreach ($shodne->getResult() as $row)
              {
                 ?> 
           <option class="zvyrazneni" value=<?php echo $row->id?>, selected> <?php echo $row->nazev;?></option>
            <?php }}
             
            foreach ($query->getResult() as $row)
            { ?> 
         <option value=<?php echo $row->idJazyky?>> <?php echo $row->nazev;}?></option>
          </select>

<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
        </div>
        <button type="submit" class="button">Upravit</button>
      </form>
    </div>

    </body>
</html>