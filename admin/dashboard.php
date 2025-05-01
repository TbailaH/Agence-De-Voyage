<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

// تحقق من الدور
if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

// الإحصائيات
$nbUsers = $conn->query("SELECT COUNT(*) AS total FROM utilisateur")->fetch_assoc()['total'];
$nbVoyages = $conn->query("SELECT COUNT(*) AS total FROM voyage")->fetch_assoc()['total'];
$nbReservations = $conn->query("SELECT COUNT(*) AS total FROM reservation")->fetch_assoc()['total'];

include('../includes/header.php');
?>

<section class="dashboard-page">
  <h2>Bienvenue Admin, <?php echo $_SESSION['user_nom']; ?> 👋</h2>

  <div class="dashboard-cards">
    
    <div class="card-dashboard">
      <h3>Voyages</h3>
      <p><?php echo $nbVoyages; ?></p>
    </div>
    <div class="card-dashboard">
      <h3>Réservations</h3>
      <p><?php echo $nbReservations; ?></p>
    </div>
  </div>

  <div class="dashboard-actions">
    <a href="reservations.php" class="btn-admin">📋 Gérer les Réservations</a>
    <a href="voyages.php" class="btn-admin">🌍 Gérer les Voyages</a>
    <a href="utilisateurs.php" class="btn-admin">👥 Gérer les Utilisateurs (<?php echo $nbUsers; ?>)</a>
    <a href="avis.php" class="btn-admin"> Gérer les Avis</a>
    <a href="rapports.php" class="btn-admin"> Rapport</a>
    <a href="programmes_du_jour.php" class="btn-admin"> Gérer  programmes du jour</a>

  </div>
</section>

<?php include('../includes/footer.php'); ?>
