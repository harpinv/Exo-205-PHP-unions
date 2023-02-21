<?php

/**
 * Reproduisez les tables présentes dans le fichier image ( via workbench ou phpmyadmin )
 * Ajoutez des donées dans chaque table en vous assurant d'ajouter au moins 1 fois un utilisateur identique dans deux tables.
 * Utilisez UNION pour récupérer les usernames de chaque table, affichez le résultat à l'aide d'un print_r ou d'une boucle.
 * Utilisez UNION ALL pour afficher toutes les données y compris les doublons, affichez le résultat  à l'aide d'une boucle ou d'un print_r.
 * PS: Si vous utilisez un print_r, alors utilisez la balise <pre> pour un résultat plus propre.
 */

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'mes_utilisateurs';

try {
    $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

    $user1 = $connect->prepare("
            SELECT username FROM user
            UNION
            SELECT username FROM admin
            UNION
            SELECT username FROM client
    ");

    $liste = $user1->execute();

    if($liste) {
        foreach ($user1->fetchAll() as $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }

    $user1 = $connect->prepare("
            SELECT username FROM user
            UNION ALL
            SELECT username FROM admin
            UNION ALL
            SELECT username FROM client
    ");

    $liste = $user1->execute();

    if($liste) {
        foreach ($user1->fetchAll() as $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}