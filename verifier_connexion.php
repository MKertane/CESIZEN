<?php
session_start();

// Infos BDD
$host = 'localhost'; 
$dbname = 'cesizen';
$username = 'root';
$password = '';

// Connexion BDD
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Connexion au site
if (isset($_POST['nom']) && isset($_POST['motDePasse'])) {
    $nom = $_POST['nom'];
    $motDePasse = hash('sha256', $_POST['motDePasse']);

    // Requête de connexion
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nom = :nom AND motDePasse = :motDePasse");
    $stmt->execute(['nom' => $nom, 'motDePasse' => $motDePasse]);
    $utilisateur = $stmt->fetch();

    // Vérification des informations de connexion
    if ($utilisateur) {
        $_SESSION['idUtilisateur'] = $utilisateur['idUtilisateur'];
        $_SESSION['nom'] = $utilisateur['nom'];
        header("Location: accueil.php");
        exit();
    } else {
        $_SESSION['erreur'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['erreur'] = "Veuillez remplir tous les champs.";
    header("Location: login.php");
    exit();
}
?>
