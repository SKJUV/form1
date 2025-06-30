<?php
// On place le code PHP au début pour une meilleure lisibilité.
// Il s'exécutera avant que le HTML ne soit envoyé au navigateur.

$message = ''; // Variable pour stocker le message à afficher

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification plus robuste que tous les champs sont bien présents ET non vides.
    if (
        !empty($_POST['nom']) && !empty($_POST['prenom']) &&
        !empty($_POST['age']) && !empty($_POST['habitat']) &&
        !empty($_POST['pays']) && !empty($_POST['ville'])
    ) {
        // Supposons que vos fichiers connexion.php et citoyen.php existent.
        // require_once("connexion.php");
        // require_once("citoyen.php");

        // Pour la démo, on simule la classe citoyen si elle n'existe pas
        if (!class_exists('citoyen')) {
            class citoyen {
                public function __construct(public string $nom, public string $prenom, public int $age, public string $habitat, public string $pays, public string $ville) {}
                public function citoyenneté() {
                    return "Bienvenue, $this->prenom $this->nom. Vos informations ont bien été enregistrées.";
                }
            }
        }

        $cit = new citoyen(
            htmlspecialchars($_POST['nom']),
            htmlspecialchars($_POST['prenom']),
            (int)$_POST['age'],
            htmlspecialchars($_POST['habitat']),
            htmlspecialchars($_POST['pays']),
            htmlspecialchars($_POST['ville'])
        );

        // On stocke le message de succès.
        $message = '<div class="php-response success">' . htmlspecialchars($cit->citoyenneté()) . '</div>';

    } else {
        // On stocke le message d'erreur.
        $message = '<div class="php-response error">Erreur : Tous les champs du formulaire sont obligatoires.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement Citoyen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* --- Reset et Style de base --- */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* --- Conteneur du Formulaire (Effet "Carte") --- */
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            transform: translateY(-20px);
            opacity: 0;
            animation: fadeInCard 0.6s ease-out forwards;
        }

        @keyframes fadeInCard {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* --- Titre --- */
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #4A4A4A;
            font-weight: 600;
        }

        /* --- Groupe de champ (Label + Input) --- */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 0.9em;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* --- Animation sur les champs --- */
        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        /* --- Bouton d'envoi --- */
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        
        button[type="submit"]:active {
            transform: translateY(-1px);
        }
        
        /* --- Style pour les messages PHP --- */
        .php-response {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
            animation: fadeInMessage 0.5s ease-in-out;
        }

        .php-response.success {
            background-color: #e0f8e9;
            color: #27ae60;
            border: 1px solid #a8e6cf;
        }

        .php-response.error {
            background-color: #fbeaea;
            color: #c0392b;
            border: 1px solid #f5c6cb;
        }

        @keyframes fadeInMessage {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>

    <main class="form-container">
        <h1>Formulaire Citoyen</h1>
        
        <?php
        // On affiche le message ici, qu'il soit vide ou non.
        if (!empty($message)) {
            echo $message;
        }
        ?>

        <!-- L'attribut action est vide pour que le formulaire se soumette à la même page -->
        <form method="post" action="">
            <!-- La structure est améliorée avec des div et des labels pour chaque champ -->
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>

            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="habitat">Habitat :</label>
                <input type="text" id="habitat" name="habitat" required>
            </div>

            <div class="form-group">
                <label for="pays">Pays :</label>
                <input type="text" id="pays" name="pays" required>
            </div>

            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required>
            </div>

            <button type="submit">Enregistrer</button>
        </form>
    </main>

</body>
</html>