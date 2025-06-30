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

    echo $cit->citoyenneté();
} else {
    echo 'Formulaire incomplet.';
}

?>


<form method="post" action="recup.php">
  Nom :      <input type="text"  name="nom"     required><br>
  Prénom :   <input type="text"  name="prenom"  required><br>
  Âge :      <input type="number" name="age"    required><br>
  Habitat :  <input type="text"  name="habitat" required><br>
  Pays :     <input type="text"  name="pays"    required><br>
  Ville :    <input type="text"  name="ville"   required><br><br>
  <button type="submit">Enregistrer</button>
</form>