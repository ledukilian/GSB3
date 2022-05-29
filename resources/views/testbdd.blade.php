<?php
try {
    DB::connection()->getPdo();
    echo 'Connexion réussie.';
} catch (\Exception $e) {
    die("Could not connect to the database.  Please check your configuration. error:" . $e );
}
?>