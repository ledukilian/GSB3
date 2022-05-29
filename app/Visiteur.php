<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model {
    protected $fillable = ['matricule', 'nom', 'prenom', 'adresse', 'cp', 'ville', 'dateembauche', 'secteur', 'labo'];
    

}
