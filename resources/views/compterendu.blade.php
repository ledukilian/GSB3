@extends("template")

@section("title", "PPE2 - Comptes-rendus")

@section("content")
<?php
if (Auth::check()) {
    $level = Auth::user()->level;
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    $lesInfos = DB::table('rapport_visite')->join('praticien', 'rapport_visite.RAP_NUM', '=', 'praticien.PRA_NUM')->join('visiteur', 'rapport_visite.VIS_MATRICULE', '=', 'visiteur.VIS_MATRICULE')->where('RAP_NUM', $id)->get();
    if (empty($lesInfos->PRA_PRENOM)) {
    ?>
<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Compte rendu N°<b><?php echo $id; ?></b></h4>
        </div>

        @foreach($lesInfos as $key => $data)
        <div id="unique">
            <table class="table">
                <?php 
                $date = $data->RAP_DATE;
                $date = date("d/m/Y", strtotime($date));
                ?>
                <tr>
                  <th scope="col">Praticien</th>
                  <td class="gras monbleu">{{$data->PRA_NOM}} {{$data->PRA_PRENOM}}</td>
                </tr>
                <tr>
                  <th scope="col">Visiteur</th>
                  <td class="gras monbleu">{{$data->VIS_NOM}} {{$data->Vis_PRENOM}}</b></td>
                </tr>
                <tr>
                  <th scope="col">Date</th>
                  <td class="gras"><?php echo $date; ?></td>
                </tr>
                <tr>
                  <th scope="col">Motif</th>
                  <td class="gras">{{$data->RAP_MOTIF}}</td>
                </tr>
                <tr>
                  <th scope="col">Bilan</th>
                  <td>{{$data->RAP_BILAN}}</td>
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
                <a href="/compterendu">
                <button class="btn btn-primary btn-sm mb-2" type="button">Retour à la liste</button>
                </a><br />
                <a href="#">
                <button class="btn btn-primary btn-sm mb-2"  onclick="window.print();" type="button">Exporter au format PDF</button>
                </a><br />
                <a href="#">
                <button class="btn btn-warning btn-sm mb-2" type="button">Modifier le compte-rendu</button>
                </a><br />
                <a href="#">
                <button class="btn btn-danger btn-sm mb-2" type="button">Supprimer le compte-rendu</button>
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
        <div class="alert alert-danger centrer"><h4>Erreur</h4><br /> Le compte rendu numéro <b><?php echo $id; ?></b> n'existe pas !<br /><br /><a href="/compterendu"><button class="btn btn-danger btn-sm mb-2" type="button">Retourner à la liste</button></a></div>
    </div>

<?php 
    }
} else {
    if (is_numeric($level)) {
        $titre = "Liste des comptes rendus";
        $compterendu = DB::table('rapport_visite')
        ->join('praticien', 'rapport_visite.RAP_NUM', '=', 'praticien.PRA_NUM')
        ->join('visiteur', 'rapport_visite.VIS_MATRICULE', '=', 'visiteur.VIS_MATRICULE')
        ->get();
    } else {
        $titre = "Liste de mes comptes rendus";
        $compterendu = DB::table('rapport_visite')
        ->join('praticien', 'rapport_visite.RAP_NUM', '=', 'praticien.PRA_NUM')
        ->join('visiteur', 'rapport_visite.VIS_MATRICULE', '=', 'visiteur.VIS_MATRICULE')
        ->where('rapport_visite.VIS_MATRICULE', $level)
        ->get();
    }

?>
<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2"><?php echo $titre; ?></h4>
        </div>
        <div class="card" style="text-align: center;">
            <table class="table table-bordered table-sm text-center">
                <tr style="background: #a2b9d8;">
                    <th>Date</th>
                    <th>Praticien</th>
                    <th>Visiteur</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @foreach($compterendu as $key => $data)
                <tr>
                    <td class="align-middle">
                        <?php 
                        $date = $data->RAP_DATE;
                        $date = date("d/m/Y", strtotime($date));
                        echo $date;
                        ?>
                        <br />
                    </td>
                    <td class="align-middle" style="color: #25508A;"><b>{{$data->PRA_NOM}} </b><br /> {{$data->PRA_PRENOM}}</td>
                    <td class="align-middle" style="color: #25508A;"><b>{{$data->VIS_NOM}} </b><br /> {{$data->Vis_PRENOM}}</td>
                    <td class="align-middle" style="color: #929292;"><small>{{$data->RAP_MOTIF}}</small></td>
                    <td class="align-middle">
                        <a href="/compterendu?id={{$data->RAP_NUM}}"><button class="btn btn-primary btn-sm mb-2" type="button">Voir</button></a>
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
            <?php
            $level = Auth::user()->level;
            if (is_numeric($level)) {
            ?>
            <h4 class="mt-2">
                <a href="/editcompterendu">
                <button class="btn btn-success btn-sm mb-2" type="button">Ajouter un compte-rendu</button>
                </a>
            </h4>
            <?php
            } else {
            ?>
            Pas d'action disponible
            <?php
            }
            ?>
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
