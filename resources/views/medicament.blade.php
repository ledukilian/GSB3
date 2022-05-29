@extends("template")

@section("title", "PPE2 - Médicaments")

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
            <h4 class="mt-2">Médicament : <b><?php echo $id; ?></b></h4>
        </div>
        <?php
        $lesInfos = DB::table('medicament')->join('famille', 'medicament.FAM_CODE', '=', 'famille.FAM_CODE')->where('MED_DEPOTLEGAL', $id)->get();
        ?>

        @foreach($lesInfos as $key => $data)
        <div id="unique">
            
            <table class="table">
                <tr>
                    <td style="width: 25%;"><img src="images/medicament.png" alt="Praticien" width="100%" /></td>
                    <td>
                        <table>
                            <tr>
                                <th scope="col">Nom</th>
                                <td class="gras">{{$data->MED_NOMCOMMERCIAL}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Famille</th>
                                <td class="gras">{{$data->FAM_LIBELLE}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Composition</th>
                                <td>{{$data->MED_COMPOSITION}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Effets</th>
                                <td>{{$data->MED_EFFETS}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Contre-indication</th>
                                <td>{{$data->MED_CONTREINDIC}}</td>
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
                <a href="/medicament">
                <button class="btn btn-primary btn-sm mb-2" type="button">Retour à la liste</button>
                </a><br />
                <a href="#">
                <button class="btn btn-warning btn-sm mb-2" type="button">Modifier le médicament</button>
                </a><br />
                <a href="#">
                <button class="btn btn-danger btn-sm mb-2" type="button">Supprimer le médicament</button>
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
            <h4 class="mt-2">Liste des médicaments</h4>
        </div>
        <div class="card" style="text-align: center;">
            <table class="table table-bordered table-sm text-center">
                <tr style="background: #a2b9d8;">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
                @foreach($medicament as $key => $data)
                <tr>
                    <td>{{$data->MED_DEPOTLEGAL}}</td>
                    <td style="color: #25508A;"><b>{{$data->MED_NOMCOMMERCIAL}} </b></td>
                    <td class="align-middle">
                        <a href="/medicament?id={{$data->MED_DEPOTLEGAL}}"><button class="btn btn-primary btn-sm mb-2" type="button">Voir</button></a>
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
                <button class="btn btn-success btn-sm mb-2" type="button">Ajouter un médicament</button><br />
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