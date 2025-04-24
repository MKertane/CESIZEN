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
    <title>Résultat - Échelle de stress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <h2>Votre score de stress</h2>

        <?php
        $score = 0;
        if (isset($_POST['evenements'])) {
            foreach ($_POST['evenements'] as $valeur) {
                $score += (int)$valeur;
            }

            echo "<p><strong>Score total :</strong> $score</p>";

            if ($score < 150) {
                echo "<p class='text-success'>Risque de maladie faible.</p>";
            } elseif ($score < 300) {
                echo "<p class='text-warning'>Risque modéré de maladie. Essayez de réduire votre stress.</p>";
            } else {
                echo "<p class='text-danger'>Risque élevé de maladie liée au stress. Il est recommandé de consulter un professionnel.</p>";
            }
        } else {
            echo "<p>Aucun événement sélectionné.</p>";
        }
        ?>
    </div>
</body>
</html>