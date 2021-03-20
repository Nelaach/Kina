<?php namespace App\Models;

use CodeIgniter\Model;

class Film_formular extends Model
{
    protected $table      = 'film';
    protected $allowedFields = ['cesky_nazev', 'originalni_nazev', 'delka_filmu', 'typ_filmu', 'zeme_idZeme', 'zanrFilmu_idZanrFilmu','promitani_idPromitani','jazyky_idJazyky'];


}