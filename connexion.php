<?php

$user='root';
$pass='';

try{

    $pdo = new PDO('mysql:host=localhost;dbname=identité;charset=utf8', $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage() ."</br>";
}

