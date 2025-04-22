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
    <title>Modifier mes informations</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h2>Modifier mes informations</h2>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color:green'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['erreur'])) {
        echo "<p style='color:red'>" . $_SESSION['erreur'] . "</p>";
        unset($_SESSION['erreur']);
    }
    ?>

    <form action="traitement_modification.php" method="POST">
        <label>Nouveau nom (laisser vide si inchangé) :</label><br>
        <input type="text" name="nouveau_nom"><br><br>

        <label>Nouveau mot de passe (laisser vide si inchangé) :</label><br>
        <input type="password" name="nouveau_motdepasse"><br><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
