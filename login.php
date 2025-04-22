<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CESIZEN - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h2>Connexion</h2>

    <?php
    if (isset($_SESSION['erreur'])) {
        echo "<p style='color:red'>" . $_SESSION['erreur'] . "</p>";
        unset($_SESSION['erreur']);
    }
    ?>

    <form action="verifier_connexion.php" method="POST">
        <label for="nom">Nom d'utilisateur :</label>
        <input type="text" name="nom" required><br><br>

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" required><br><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
