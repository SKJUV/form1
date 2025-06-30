<?php
require_once ("connexion.php");
require_once ("citoyen.php");

if (
    isset($_POST['nom'], $_POST['prenom'], $_POST['age'],
          $_POST['habitat'], $_POST['pays'], $_POST['ville'])
) {
    $cit = new citoyen(
        $_POST['nom'],
        $_POST['prenom'],
        (int)$_POST['age'],
        $_POST['habitat'],
        $_POST['pays'],
        $_POST['ville']
    );


    $sql = "INSERT INTO citoyen(nom, prenom, age, habitat, pays, ville)
            VALUES (:nom, :prenom, :age, :habitat, :pays, :ville)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom'     => $_POST['nom'],
        ':prenom'  => $_POST['prenom'],
        ':age'     => $_POST['age'],
        ':habitat' => $_POST['habitat'],
        ':pays'    => $_POST['pays'],
        ':ville'   => $_POST['ville']
    ]);

    echo $cit->citoyenneté() . '<br>Enregistrement effectué !';
} else {
    echo 'Formulaire incomplet.';
}

?>