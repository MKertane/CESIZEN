<?php
session_start();

if (!isset($_SESSION['idUtilisateur'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$dbname = 'cesizen';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$id = $_SESSION['idUtilisateur'];
$nouveauNom = trim($_POST['nouveau_nom']);
$nouveauMotDePasse = trim($_POST['nouveau_motdepasse']);

if (empty($nouveauNom) && empty($nouveauMotDePasse)) {
    $_SESSION['erreur'] = "Aucune modification détectée.";
    header("Location: modifier_profil.php");
    exit();
}

$params = [];
$sql = "UPDATE utilisateur SET ";
$updates = [];

if (!empty($nouveauNom)) {
    $updates[] = "nom = :nom";
    $params['nom'] = $nouveauNom;
    $_SESSION['nom'] = $nouveauNom;
}

if (!empty($nouveauMotDePasse)) {
    $updates[] = "motDePasse = :motDePasse";
    $params['motDePasse'] = $nouveauMotDePasse;
}

$sql .= implode(', ', $updates) . " WHERE idUtilisateur = :idUtilisateur";
$params['idUtilisateur'] = $id;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$_SESSION['message'] = "Informations mises à jour avec succès.";
header("Location: modifier_profil.php");
exit();
