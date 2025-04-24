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

<section class="admin-voyages">
  <h2>Liste des Voyages</h2>
  <a href="ajouter_voyage.php" class="btn">➕ Ajouter un voyage</a>

  <table class="admin-table">
  <thead>
  <tr>
    <th>ID</th>
    <th>Image</th>
    <th>Titre</th>
    <th>Destination</th>
    <th>Départ</th>
    <th>Retour</th>
    <th>Prix</th>
    <th>Places</th>
    <th>Actions</th>
  </tr>
</thead>

  <tbody>

      <?php
      $result = $conn->query("SELECT * FROM voyage ORDER BY date_depart ASC");
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><img src='../images/{$row['image']}' width='60' style='border-radius:6px;'></td>";
        echo "<td>{$row['titre']}</td>";

        echo "<td>{$row['destination']}</td>";
        echo "<td>{$row['date_depart']}</td>";
        echo "<td>{$row['date_retour']}</td>";
        echo "<td>{$row['prix']} DH</td>";
        echo "<td>{$row['places_disponibles']}</td>";

        echo "<td>
                <a href='modifier_voyage.php?id={$row['id']}' class='btn-edit'>✏️</a>
                <a href='supprimer_voyage.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Confirmer la suppression ?')\">❌</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</section>

<?php include('../includes/footer.php'); ?>
