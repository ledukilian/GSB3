@extends("template")

@section("title", "PPE Mission 2")

@section("content")
<?php
function getBdd() {
  //$host = 'mysql-ledukilian.alwaysdata.net';
  //$bdd = 'ledukilian_gsb';
  $user = 'root'; 
  $pass = '';
    return new PDO('mysql:host=localhost;dbname=gsb;charset = utf8', $user, $pass);
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}

if (isset($_POST['ajouterCR'])) {
  $bdd = getBdd();
  $query = $bdd->prepare("INSERT INTO rapport_visite VALUES (:visiteur, NULL, :praticien, :date, :bilan, :motif)");
  $query -> BindValue(':visiteur', $_POST['visiteur']);
  $query -> BindValue(':praticien', $_POST['praticien']);
  $query -> BindValue(':date', date("Y-m-d H:i:s"));
  $query -> BindValue(':bilan', $_POST['bilan']);
  $query -> BindValue(':motif', $_POST['motif']);
  $query->execute();
}


if (Auth::check()) {
?>
<div class="container">
  <div class="row">
    <div class="col-1 col-md-9">
        <div class="card text-white titre">
            <h4 class="mt-2">Ajouter un compte-rendu</h4>
        </div>
        <div class="card" style="text-align: center;"><br />
          <form action="editcompterendu" method="post" name="ajouterCR">
          @csrf
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Praticien</label>
            <div class="col-sm-9">
              <?php
                $id = Auth::user()->level;
                $lesInfos = DB::table('praticien')->join('type_praticien', 'praticien.TYP_CODE', '=', 'type_praticien.TYP_CODE')->where('PRA_NUM', $id)->orderBy('PRA_COEFNOTORIETE', 'DESC')->get();

              ?>
              @foreach($lesInfos as $key => $data)
              <select class="form-control" name="praticien">
                <option value="{{$data->PRA_NUM}}">{{$data->PRA_NOM}} {{$data->PRA_PRENOM}} (moi)</option>
              </select>
              @endforeach

              <?php

              ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Visiteur</label>
            <div class="col-sm-9">
              <?php
                $visiteur = DB::table('visiteur')->get();
              ?>
              <select class="form-control" name="visiteur">
                @foreach($visiteur as $key => $data)
                <option value="{{$data->VIS_MATRICULE}}">{{$data->VIS_NOM}} {{$data->Vis_PRENOM}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Motif</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputPassword" autocomplete="off" placeholder="Motif" name="motif">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Bilan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputPassword" autocomplete="off" placeholder="Bilan" name="bilan">
            </div>
          </div>

          <button class="btn btn-success btn-sm mb-2" type="submit" name="ajouterCR">Ajouter le compte-rendu</button>
        </div>
    </div>
  </form>
    <div class="col-1 col-md-3">
        <div class="card text-white titre">
            <h4 class="mt-2">Actions</h4>
        </div>
        <div class="card" style="text-align: center;">
            <h4 class="mt-2">
                <a href="/compterendu">
                <button class="btn btn-primary btn-sm mb-2" type="button">Retour à la liste</button>
                </a>
            </h4>
        </div>
    </div>
    <div class="col-1 col-md-1" style="text-align: center;">
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
