<?php
session_start();
if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Échelle de stress - Holmes & Rahe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4">Questionnaire : Échelle de stress de Holmes et Rahe</h2>

        <form method="POST" action="resultat_stress.php">
            <p>Pour chaque événement que vous avez vécu au cours des 12 derniers mois, cochez la case correspondante.</p>

            <?php
            // Liste d'exemples tirés de l'échelle
            $evenements = [
                "Décès du conjoint" => 100,
                "Divorce" => 73,
                "Séparation" => 65,
                "Peine de prison" => 63,
                "Décès d’un proche parent" => 63,
                "Blessure ou maladie personnelle" => 53,
                "Mariage" => 50,
                "Perte d’emploi" => 47,
                "Retraite" => 45,
                "Grossesse" => 40,
                "Difficultés financières" => 38,
                "Changement de responsabilités professionnelles" => 29,
                "Vacances" => 13,
            ];

            foreach ($evenements as $evenement => $valeur) {
                echo "<div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='evenements[]' value='$valeur' id='".md5($evenement)."'>
                        <label class='form-check-label' for='".md5($evenement)."'>
                            $evenement ($valeur points)
                        </label>
                      </div>";
            }
            ?>

            <button type="submit" class="btn btn-primary mt-3">Calculer mon score</button>
        </form>
    </div>
</body>
</html>
