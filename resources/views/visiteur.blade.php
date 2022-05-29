@extends("template")

@section("title", "PPE2 - Visiteurs")

@section("content")
<?php
if (Auth::check()) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        ?>
<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Visiteur <b><?php echo $id; ?></b></h4>
        </div>
        <?php
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
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
        <div class="col-1 col-md-3">
        <div class="card text-white titre">
            <h4 class="mt-2">Actions</h4>
        </div>
        <div class="card" style="text-align: center;">
            <h4 class="mt-2">
                <a href="/visiteur">
                <button class="btn btn-primary btn-sm mb-2" type="button">Retour à la liste</button>
                </a><br />
                <a href="#">
                <button class="btn btn-warning btn-sm mb-2" type="button">Modifier le visiteur</button>
                </a><br />
                <a href="#">
                <button class="btn btn-danger btn-sm mb-2" type="button">Supprimer le visiteur</button>
                </a>
            </h4>
        </div>
    </div>
</div>
</div>
<?php
    } else {
?>
<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Liste des visiteurs</h4>
        </div>
        <div class="card" style="text-align: center;">
            <table class="table table-bordered table-sm text-center">
                <tr style="background: #a2b9d8;">
                    <th>ID</th>
                    <th>Identité</th>
                    <th>Ville</th>
                    <th>Action</th>
                </tr>
                @foreach($visiteur as $key => $data)
                <tr>
                    <td class="align-middle">{{$data->VIS_MATRICULE}}</td>
                    <td class="align-middle" style="color: #25508A;"><b>{{$data->VIS_NOM}} </b> {{$data->Vis_PRENOM}}</td>
                    <td class="align-middle"><small><b>{{$data->VIS_CP}}</b> {{$data->VIS_VILLE}}</small></td>
                    <td class="align-middle">
                        <a href="/visiteur?id={{$data->VIS_MATRICULE}}"><button class="btn btn-primary btn-sm mb-2" type="button">Voir</button></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-1 col-md-3">
        <div class="card text-white titre">
            <h4 class="mt-2">Actions</h4>
        </div>
        <div class="card" style="text-align: center;">
            <h4 class="mt-2">
                <button class="btn btn-success btn-sm mb-2" type="button">Ajouter un visiteur</button>
            </h4>
        </div>
    </div>
    <div class="col-1 col-md-1" style="text-align: center;">
    </div>
  </div>
</div>
<?php 
    }
} else {
?>
    <div class="container">
        <div class="alert alert-warning">Vous devez être connecté pour accéder à cette page. <a href="/connexion">Se connecter</a></div>
    </div>

<?php 
}
?>
@endsection
