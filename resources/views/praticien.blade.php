@extends("template")

@section("title", "PPE2 - Praticiens")

@section("content")
<?php
if (Auth::check()) {
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
?>

<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Praticien N°<b><?php echo $id; ?></b></h4>
        </div>
        <?php
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
    </div>
        <div class="col-1 col-md-3">
        <div class="card text-white titre">
            <h4 class="mt-2">Actions</h4>
        </div>
        <div class="card" style="text-align: center;">
            <h4 class="mt-2">
                <a href="/praticien">
                <button class="btn btn-primary btn-sm mb-2" type="button">Retour à la liste</button>
                </a><br />
                <a href="#">
                <button class="btn btn-warning btn-sm mb-2" type="button">Modifier le praticien</button>
                </a><br />
                <a href="#">
                <button class="btn btn-danger btn-sm mb-2" type="button">Supprimer le praticien</button>
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
            <h4 class="mt-2">Liste des praticiens</h4>
        </div>
        <div class="card" style="text-align: center;">
            <table class="table table-bordered table-sm text-center">
                <tr style="background: #a2b9d8;">
                    <th>Notoriété</th>
                    <th>Identité</th>
                    <th>Type</th>
                    <th>Ville</th>
                    <th>Action</th>
                </tr>
                <?php 
                if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                    if ($_GET['type']!="ALL") {
                    $praticien = DB::table('praticien')->join('type_praticien', 'praticien.TYP_CODE', '=', 'type_praticien.TYP_CODE')->where('praticien.TYP_CODE', $type)->get();
                    } else {
                    $praticien = DB::table('praticien')->join('type_praticien', 'praticien.TYP_CODE', '=', 'type_praticien.TYP_CODE')->get();

                    }
                } else {
                    $praticien = DB::table('praticien')->join('type_praticien', 'praticien.TYP_CODE', '=', 'type_praticien.TYP_CODE')->get();
                }
                ?>
                @foreach($praticien as $key => $data)
                <tr>
                    <td class="align-middle">{{$data->PRA_COEFNOTORIETE}}</td>
                    <td class="align-middle" style="color: #25508A;"><b>{{$data->PRA_NOM}} </b> {{$data->PRA_PRENOM}}</td>
                    <td class="align-middle" style="font-size: 12px;color: #999999">{{$data->TYP_LIBELLE}}</td>
                    <td class="align-middle"><small>{{$data->PRA_CP}} {{$data->PRA_VILLE}}</small></td>
                    <td class="align-middle">
                        <a href="/praticien?id={{$data->PRA_NUM}}"><button class="btn btn-primary btn-sm mb-2" type="button">Voir</button></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-1 col-md-3">
        <div class="card text-white titre">
            <h4 class="mt-2">Filtres</h4>
        </div>
        <?php
        $lesTypes = DB::table('type_praticien')->get();
        ?>
        <form action="/praticien" method="GET">
        <select name="type"  class="form-control form-control-sm" onchange="this.form.submit()">
            <option selected value="ALL">Tous les types</option>
        @foreach($lesTypes as $key => $data)
        <?php
        if (isset($_GET['type'])) {
            if ($_GET['type']==($data->TYP_CODE)) {
                echo '<option selected value="'.$data->TYP_CODE.'">'.$data->TYP_LIBELLE.'</option>';
            } else {
                echo '<option value="'.$data->TYP_CODE.'">'.$data->TYP_LIBELLE.'</option>';
            }
        } else {
                echo '<option value="'.$data->TYP_CODE.'">'.$data->TYP_LIBELLE.'</option>';

        }
        ?>
            
        @endforeach
        </select>
        </form>
        <br />
        <div class="card text-white titre">
            <h4 class="mt-2">Actions</h4>
        </div>
        <div class="card" style="text-align: center;">
            <h4 class="mt-2">
                <button class="btn btn-success btn-sm mb-2" type="button">Ajouter un practicien</button>
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
