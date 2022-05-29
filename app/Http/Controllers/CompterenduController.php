<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compterendu;
use Session;

class Controller extends Controller
{
public function ajouterCompterendu(Request $request) {
        $praticien = $request->input('PRA_NUM');
        $visiteur = $request->input('VIS_MATRICULE');
        $date = $request->input('RAP_DATE');
        $bilan = $request->input('RAP_BILAN');
        $motif = $request->input('RAP_MOTIF');

}


}
