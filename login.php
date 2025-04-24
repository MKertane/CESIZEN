<?php
session_start();
?>

<?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-success text-center">
    <?= $_SESSION['message']; ?>
  </div>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['erreur'])): ?>
  <div class="alert alert-danger text-center">
    <?= $_SESSION['erreur']; ?>
  </div>
  <?php unset($_SESSION['erreur']); ?>
<?php endif; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> CESIZEN - Connexion</title>
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

<form action="verifier_connexion.php" method="post">
  <div class="mb-3">
    <label for="nom" class="form-label">Nom d'utilisateur</label>
    <input type="text" class="form-control" id="nom" name="nom" required>
  </div>
  <div class="mb-3">
    <label for="motDePasse" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="motDePasse" name="motDePasse" required>
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
  <a href="inscription.php" class="btn btn-secondary ms-2">S'inscrire</a>
</form>

</body>
</html>
