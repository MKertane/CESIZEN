<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['motDePasse'])) {
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $motDePasseBrut = trim($_POST['motDePasse']);

        // Vérification de la robustesse du mot de passe
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $motDePasseBrut)) {
            $_SESSION['erreur'] = "Le mot de passe doit contenir au minimum 8 caractères, dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
        } else {
            // Hachage SHA-256 sans salt
            $motDePasse = hash('sha256', $motDePasseBrut);

            try {
                $pdo = new PDO("mysql:host=localhost;dbname=cesizen;charset=utf8", "root", "", [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, motDePasse) VALUES (:nom, :prenom, :motDePasse)");
                $stmt->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'motDePasse' => $motDePasse
                ]);

                $_SESSION['message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                $_SESSION['erreur'] = "Erreur BDD : " . $e->getMessage();
            }
        }
    } else {
        $_SESSION['erreur'] = "Tous les champs doivent être remplis.";
    }
}
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Créer un compte</h2>

  <?php if (isset($_SESSION['erreur'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?></div>
  <?php endif; ?>

  <form method="post" action="">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control" name="nom" id="nom" required>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" name="prenom" id="prenom" required>
    </div>
    <div class="mb-3">
      <label for="motDePasse" class="form-label">Mot de passe</label>
      <input type="password" class="form-control" name="motDePasse" id="motDePasse" required>
    </div>
    <button type="submit" class="btn btn-success">S'inscrire</button>
    <a href="login.php" class="btn btn-link">Retour à la connexion</a>
  </form>
</body>
</html>
