<?php
// نستخدم هذا باش نعرف واش حنا داخل مجلد admin
$prefix = isset($admin) ? '../' : '';
?>
<?php
// إذا كان المشرف داخل، نجيب عدد الرسائل
$notif_count = 0;
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
  include_once($prefix . 'includes/db.php');
  $res = $conn->query("SELECT COUNT(*) as total FROM message_contact WHERE statut = 'non lu'");
  $notif_count = $res->fetch_assoc()['total'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Agence de Voyages</title>
  <link rel="stylesheet" href="<?php echo $prefix; ?>css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
/* ===== HEADER ===== */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #007BFF;
  color: white;
  padding: 15px 30px;
  flex-wrap: wrap;
}

.logo a {
  font-size: 24px;
  font-weight: bold;
  text-decoration: none;
  color: white;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 20px;
  margin: 0;
  padding: 0;
}

.nav-links li {
  display: inline;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #ffc107;
}

/* إشعار */
.notif-badge {
  background-color: red;
  color: white;
  font-size: 10px;
  padding: 2px 6px;
  border-radius: 50%;
  position: relative;
  top: -10px;
  left: -5px;
}
</style>

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
        <li><a href="client/profil.php">👤 Profil</a></li>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
  <li>
    <a href="<?php echo $prefix; ?>admin/message_contact.php">
      <i class="fa-solid fa-envelope"></i>
      <?php if ($notif_count > 0): ?>
        <span class="notif-badge"><?php echo $notif_count; ?></span>
      <?php endif; ?>
    </a>
  </li>
<?php endif; ?>

        <li><a href="client/notifications.php">
          <i class="fa-solid fa-bell"></i>
          <span class="notif-badge">0</span>
        </a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
