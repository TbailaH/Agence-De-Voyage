<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

// حذف التقييم
if (isset($_GET['supprimer'])) {
  $id = intval($_GET['supprimer']);
  $stmt = $conn->prepare("DELETE FROM avis WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  header("Location: avis.php");
  exit;
}

include('../includes/header.php');
?>

<section class="admin-avis">
  <h2>Gestion des avis</h2>

  <table class="admin-table">
    <thead>
      <tr>
        <th>Note</th>
        <th>Commentaire</th>
        <th>Voyage</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT a.*, v.titre AS voyage_titre 
              FROM avis a 
              JOIN voyage v ON a.voyage_id = v.id 
              ORDER BY a.date_publication DESC";
      $res = $conn->query($sql);
      while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . str_repeat("⭐", $row['note']) . "</td>";
        echo "<td>" . htmlspecialchars($row['commentaire']) . "</td>";
        echo "<td>" . htmlspecialchars($row['voyage_titre']) . "</td>";
        echo "<td>" . $row['date_publication'] . "</td>";
        echo "<td><a href='avis.php?supprimer={$row['id']}' class='btn-delete' onclick=\"return confirm('Confirmer la suppression ?')\">🗑️ Supprimer</a></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</section>

<?php include('../includes/footer.php'); ?>
