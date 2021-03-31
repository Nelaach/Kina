<?php namespace App\Models;

use CodeIgniter\Model;

class Sal_formular extends Model
{
    protected $table      = 'sal';
    protected $primaryKey = 'idSal';
    protected $allowedFields = ['idSal', 'nazev', 'kapacita', '3D', 'prostorovyZvuk', 'promitani_idPromitani'];
    protected $updatedField  = 'updated_at';


}