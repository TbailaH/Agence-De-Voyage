<?php
// نستخدم هذا باش نعرف واش حنا داخل مجلد admin
$prefix = isset($admin) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Agence de Voyages</title>
  <link rel="stylesheet" href="<?php echo $prefix; ?>css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
</head>
<body>

<!-- Navigation -->
<header>
  <nav class="navbar">
    <div class="logo">
      <a href="index.php">🌍 Voyages Maroc</a>
    </div>
    <ul class="nav-links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="voyages.php">Voyages</a></li>
      <li><a href="apropos.php">À propos</a></li>
      <li><a href="contact.php">Contact</a></li>

      <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Si utilisateur non connecté -->
        <li><a href="login.php">Connexion</a></li>
        <li><a href="register.php">Inscription</a></li>
      <?php else: ?>
        <!-- Si utilisateur connecté -->
        <li><a href="logout.php">Déconnexion</a></li>
        <li><a href="client/notifications.php">
          <i class="fa-solid fa-bell"></i>
          <span class="notif-badge">3</span>
        </a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
