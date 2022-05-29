<?php
// Index du site GSB
Route::get('/', function () { return view('home'); });
Route::get('/home', function () { return view('home'); });
//Route::get('/testbdd', function () { return view('testbdd'); });

// Page "Compte-rendu" du site GSB : requête avec Inner Join
Route::get('/compterendu', function () {
	$compterendu = DB::table('rapport_visite')
	->join('praticien', 'rapport_visite.RAP_NUM', '=', 'praticien.PRA_NUM')
	->join('visiteur', 'rapport_visite.VIS_MATRICULE', '=', 'visiteur.VIS_MATRICULE')
	->get();
	return view('compterendu', ['compterendu' => $compterendu]); 
});

// Page "Visiteur" du site GSB : requête simple
Route::get('/visiteur', function () {
	$visiteur = DB::table('visiteur')->get();
	return view('visiteur', ['visiteur' => $visiteur]); 
});

// Page "Practicien" du site GSB : requête simple
Route::get('/praticien', function () {
	return view('praticien'); 
});

// Page "Médicament" du site GSB : requête simple
Route::get('/medicament', function () {
	$medicament = DB::table('medicament')->get();
	return view('medicament', ['medicament' => $medicament]); 
});

// Page "Connexion" du site GSB
Route::get('/connexion', function () { 
	return view('connexion');
});

// Page "Inscription" du site GSB
Route::get('/inscription', function () { 
	return view('inscription');
});

// Page "template" du site GSB
Route::get('template', function () { 
	return view('template');
});

// Page "Profil" du site GSB
Route::get('/profil', function () { return view('profil'); });

// Page formulaire "Compte-Rendu" du site GSB
Route::get('/editcompterendu', function () { return view('/editcompterendu'); });
Route::post('/editcompterendu', function () { return view('/editcompterendu'); });
Route::put('/editcompterendu', function () { return view('/editcompterendu'); });
//Route::get('/compterendu/ajouter/{id}', "CompteRendus@ajouter")->name('cr.ajouter');

Auth::routes();

