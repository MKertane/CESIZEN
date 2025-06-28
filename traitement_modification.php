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
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$id = $_SESSION['idUtilisateur'];
$nouveauNom = trim($_POST['nouveau_nom']);
$nouveauMotDePasseBrut = trim($_POST['nouveau_motdepasse']);

if (empty($nouveauNom) && empty($nouveauMotDePasseBrut)) {
    $_SESSION['erreur'] = "Aucune modification détectée.";
    header("Location: modifier_profil.php");
    exit();
}

$params = [];
$sql = "UPDATE utilisateur SET ";
$updates = [];

// Modification du nom
if (!empty($nouveauNom)) {
    $updates[] = "nom = :nom";
    $params['nom'] = $nouveauNom;
    $_SESSION['nom'] = $nouveauNom;
}

// Modification du mot de passe
if (!empty($nouveauMotDePasseBrut)) {
    // Vérification de la robustesse du mot de passe
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $nouveauMotDePasseBrut)) {
        $_SESSION['erreur'] = "Le nouveau mot de passe doit contenir au minimum 8 caractères, dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
        header("Location: modifier_profil.php");
        exit();
    }
    $updates[] = "motDePasse = :motDePasse";
    $params['motDePasse'] = hash('sha256', $nouveauMotDePasseBrut);
}

// Mise à jour
$sql .= implode(', ', $updates) . " WHERE idUtilisateur = :idUtilisateur";
$params['idUtilisateur'] = $id;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$_SESSION['message'] = "Informations mises à jour avec succès.";
header("Location: modifier_profil.php");
exit();
?>
