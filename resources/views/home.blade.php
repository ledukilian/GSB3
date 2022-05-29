@extends("template")

@section("title", "PPE2 - Accueil")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-6 col-md-1" style="text-align: center;">
    </div>
    <div class="col-12 col-md-10">
        <div class="card" style="text-align: center;">
            <?php
            if (Auth::check()) {
                $userId = Auth::id();
                $userEmail = Auth::user()->email;
                $userName = Auth::user()->name;
            ?>
            <div class="alert alert-success">Connecté en tant que <b><?php echo $userEmail ?></b></div>
            <?php 
            } else {
            ?>
            <div class="alert alert-info">Vous n'êtes pas connecté, <a href="/connexion">se connecter ?</a></div>
            <?php 
            }
            ?>
            <center><img src="images/logo.png" width="40%" height="auto" alt="Logo GSB" style="margin-top: 40px;margin-bottom: 40px;"></center>
            <h3 class="display-6">Bienvenue sur l'application GSB</h3>
            <br />
        </div>
    </div>
    <div class="col-6 col-md-1" style="text-align: center;">
    </div>
  </div>
</div>

@endsection
