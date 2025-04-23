<?php
session_start();
$admin = true; // علامة باش نستعملها فـ header

include('../includes/db.php');
include('../includes/auth.php');

// التأكد أن المستخدم "admin"
if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

// جلب الإحصائيات
$nbUsers = $conn->query("SELECT COUNT(*) AS total FROM utilisateur")->fetch_assoc()['total'];
$nbVoyages = $conn->query("SELECT COUNT(*) AS total FROM voyage")->fetch_assoc()['total'];
$nbReservations = $conn->query("SELECT COUNT(*) AS total FROM reservation")->fetch_assoc()['total'];

include('../includes/header.php');
?>

<section class="dashboard-page">
  <h2>Bienvenue Admin, <?php echo $_SESSION['user_nom']; ?> 👋</h2>

  <div class="dashboard-cards">
    <div class="card-dashboard">
      <h3>Utilisateurs</h3>
      <p><?php echo $nbUsers; ?></p>
    </div>
    <div class="card-dashboard">
      <h3>Voyages</h3>
      <p><?php echo $nbVoyages; ?></p>
    </div>
    <div class="card-dashboard">
      <h3>Réservations</h3>
      <p><?php echo $nbReservations; ?></p>
    </div>
  </div>
</section>

<?php include('../includes/footer.php'); ?>
