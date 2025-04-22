<?php
session_start();

include 'navbar.php';

if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- Page d'accueil -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CESIZEN - Accueil</title>
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?> !</h1>
    <p>Vous êtes connecté.</p>
</body>
</html>
