<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kilian LE DU, Fanny GOYET">
        <meta name="description" content="PPE Mission 2 GSB Laravel">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'PPE Mission 2')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/print.css') }}" rel="stylesheet">
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <link rel="icon" type="image/png" href="images/logo.png">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top text-white ombrenavbar" style="background: #2f6bbd;">

            <a class="navbar-brand" href="/">
            <img src="images/logo.png" width="50" id="logo" height="auto" class="d-inline-block align-top" alt="">
            </a>
            <?php
            if (Auth::check()) {
                $userName = Auth::user()->username;
                $level = Auth::user()->level;
                $id = $level;
            ?>
            <a class="navbar-brand" href="/compterendu">
                <button class="btn btn-outline-light" type="button">Compte-rendus</button>
            </a>
            <a class="navbar-brand" href="/praticien">
                <button class="btn btn-outline-light" type="button">Praticiens</button>
            </a>
            <?php
            if ($level==1) {
            ?>
            <a class="navbar-brand" href="/visiteur">
                <button class="btn btn-outline-light" type="button">Visiteurs</button>
            </a>
            <?php
            }
            ?>
            <a class="navbar-brand" href="/medicament">
                <button class="btn btn-outline-light" type="button">Médicaments</button>
            </a>
            <a class="navbar-brand" href="/profil">
                <button class="btn btn-outline-light" type="button">Profil</button>
            </a>
            <?php 
            if (is_numeric($level)) {
                $lesInfos = DB::table('praticien')->where('PRA_NUM', $id)->orderBy('PRA_COEFNOTORIETE', 'DESC')->get();
                ?>

                @foreach($lesInfos as $key => $data)

                <?php
                $nomCompose = $data->PRA_NOM;
                $nomCompose = $nomCompose." ".$data->PRA_PRENOM;
                ?>

                @endforeach

                <?php
            }

            if (!is_numeric($level)) {
                $lesInfos = DB::table('visiteur')->where('VIS_MATRICULE', $id)->get();
                ?>

                @foreach($lesInfos as $key => $data)

                <?php
                $nomCompose = $data->VIS_NOM;
                $nomCompose = $nomCompose." ".$data->Vis_PRENOM;
                ?>

                @endforeach

                <?php
            }


            echo "Bonjour&nbsp;
            <b> ".$nomCompose." </b>&nbsp;
            !&nbsp;
            &nbsp;
            "; ?>   
            <a class="navbar-brand" href="#">
                <button class="btn btn-danger btn-sm" type="button" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Déconnexion</button>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>

            <?php
            } else {
            ?>            
            <a class="navbar-brand" href="/connexion">
                <button class="btn btn-success btn-sm" type="button">Connexion</button>
            </a>           
            <?php 
            }
            ?>
        </nav>

        <!-- Message d'échec (ROUGE) -->
        @if(Session::has('alert'))
            <p class="alert alert-danger">{{ Session::get('alert') }}</p>
        @endif

        <!-- Message d'information (BLEU) -->
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        @yield('content', 'Yield Content')


        <div id="monFooter">
            <b>PPE Laravel</b> - BTS SIO2 SLAM <?php echo date('Y'); ?><br />LE DU Kilian<br />GOYET Fanny
        </div>

    </body>
</html>