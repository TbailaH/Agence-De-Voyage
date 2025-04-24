<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

include('../includes/header.php');
?>

<section class="admin-reservations">
  <h2>Liste des Réservations</h2>

  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom du passager</th>
        <th>Téléphone</th>
        <th>Voyage</th>
        <th>Nombre de personnes</th>
        <th>Date</th>
        <th>Statut</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT r.*, v.titre FROM reservation r 
      JOIN voyage v ON r.voyage_id = v.id 
      ORDER BY r.id DESC";

      $res = $conn->query($sql);
      while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nom_passager']}</td>";
        echo "<td>{$row['telephone']}</td>";
        echo "<td>{$row['titre']}</td>";
        echo "<td>{$row['nombre_personnes']}</td>";
        echo "<td>{$row['date_reservation']}</td>";
        echo "<td>{$row['statut']}</td>";

        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</section>

<?php include('../includes/footer.php'); ?>
