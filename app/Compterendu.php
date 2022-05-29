<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compterendu extends Model {
    protected $fillable = ['VIS_MATRICULE', 'RAP_NUM', 'PRA_NUM', 'RAP_DATE', 'RAP_BILAN', 'RAP_MOTIF'];
    

}