@extends("template")

@section("title", "PPE Mission 2")

@section("content")


<div class="container">
  <div class="row">
    <?php 
    if (Auth::check()) {
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $userName = Auth::user()->username;
        $level = Auth::user()->level;
        $id = $level;

        // Attribution d'une image interrogation en cas d'erreur
        $image = '<img class="imageDesc" src="images/warning.png" alt="Profil" />';


        // Traitement pour savoir si Visiteur ou Praticien
        // Si matricule numérique (sans lettres) alors c'est un PRATICIEN
        if (is_numeric($level)) {
            $position = "Praticien";
            $image = '<img class="imageDesc" src="images/praticien.png" alt="Profil" />';

        }
        // Si matricule non numérique (avec lettres) alors c'est un VISITEUR
        if (!is_numeric($level)) {
            $position = "Visiteur";
            $image = '<img class="imageDesc" src="images/visiteur.png" alt="Profil" />';
        }

    ?>
    <div class="col-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Mon profil</h4>
        </div>
        <div class="card" style="text-align: center;">
        <?php
        // Si matricule numérique (sans lettres) alors c'est un PRATICIEN
        if (is_numeric($level)) {
        $lesInfos = DB::table('praticien')->join('type_praticien', 'praticien.TYP_CODE', '=', 'type_praticien.TYP_CODE')->where('PRA_NUM', $id)->orderBy('PRA_COEFNOTORIETE', 'DESC')->get();
        ?>

        @foreach($lesInfos as $key => $data)
        <div id="unique">
            
            <table class="table">
                <tr>
                    <td style="width: 25%;"><img class="imageDesc" src="images/praticien.png" alt="Praticien" /></td>
                    <td>
                        <table>
                            <tr>
                                <th scope="col" style="width: 33%;">Position</th>
                                <td class="gras monbleu"><span class="designation"><?php echo $position; ?></span></td>
                            </tr>
                            <tr>
                                <th scope="col">E-mail</th>
                                <td class="gras monbleu"><?php echo $userEmail; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nom d'utilisateur</th>
                                <td class="gras monbleu"><?php echo $userName; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nom</th>
                                <td class="gras">{{$data->PRA_NOM}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Prénom</th>
                                <td class="gras">{{$data->PRA_PRENOM}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Type</th>
                                <td class="gras">{{$data->TYP_LIBELLE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Adresse</th>
                                <td>{{$data->PRA_ADRESSE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Ville</th>
                                <td>{{$data->PRA_CP}} {{$data->PRA_VILLE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Notorieté</th>
                                <td class="gras monbleu">{{$data->PRA_COEFNOTORIETE}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
        <?php
        }
        // Si matricule non numérique (avec lettres) alors c'est un VISITEUR
        if (!is_numeric($level)) {
        $lesInfos = DB::table('visiteur')->where('VIS_MATRICULE', $id)->get();
        ?>

        @foreach($lesInfos as $key => $data)
        <div id="unique">
            
            <table class="table">
                <tr>
                    <td style="width: 25%;"><img class="imageDesc" src="images/visiteur.png" alt="Praticien" /></td>
                    <td>
                        <table>
                            <tr>
                                <th scope="col" style="width: 33%;">Position</th>
                                <td class="gras monbleu"><span class="designation"><?php echo $position; ?></span></td>
                            </tr>
                            <tr>
                                <th scope="col">E-mail</th>
                                <td class="gras monbleu"><?php echo $userEmail; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nom d'utilisateur</th>
                                <td class="gras monbleu"><?php echo $userName; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Nom</th>
                                <td class="gras">{{$data->VIS_NOM}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Prénom</th>
                                <td class="gras">{{$data->Vis_PRENOM}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Adresse</th>
                                <td>{{$data->VIS_ADRESSE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Ville</th>
                                <td>{{$data->VIS_CP}} {{$data->VIS_VILLE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Date d'embauche</th>
                                <td>{{$data->VIS_DATEEMBAUCHE}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        @endforeach

        <?php
        }
        ?>
        </div>
    </div>
    <div class="col-3">
            <div class="card text-white titre">
                <h4 class="mt-2">Actions</h4>
            </div>
            <div class="card" style="text-align: center;">
                <h4 class="mt-2">
                    <button class="btn btn-primary btn-sm mb-2" type="button">Modifier mon profil</button><br />
                    <button class="btn btn-danger btn-sm mb-2" type="button">Supprimer mon profil</button>
                </h4>
            </div>
        </div>
  </div>
</div>
<?php
} else {
?>
    <div class="container">
        <div class="alert alert-warning">Vous devez être connecté pour accéder à cette page. <a href="/connexion">Se connecter</a></div>
    </div>
<?php
}
?>
@endsection
