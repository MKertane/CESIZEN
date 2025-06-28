<?php
if (!isset($_SESSION)) session_start();
?>

<!-- Intégration de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Mon Espace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['idUtilisateur'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modifier_profil.php">Modifier mon profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="questionnaire_stress.php">Échelle de stress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Se déconnecter</a>
                </li>
            <?php } else {
                header("Location: login.php");
            };?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS (nécessaire pour le responsive toggle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
