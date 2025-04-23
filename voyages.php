<?php
session_start();
include('includes/db.php');
include('includes/header.php');
?>

<section class="voyages">
  <h2>Nos voyages organisés</h2>
  <div class="voyage-list">

    <?php
    $query = "SELECT * FROM voyage ORDER BY date_depart ASC";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="voyage-card">';
        echo '<img src="images/' . $row['image'] . '" alt="' . $row['destination'] . '">';
        echo '<h3>' . $row['titre'] . '</h3>';
        echo '<p><strong>Destination :</strong> ' . $row['destination'] . '</p>';
        echo '<p><strong>Prix :</strong> ' . $row['prix'] . ' DH</p>';
        echo '<a href="details.php?id=' . $row['id'] . '" class="btn">Voir détails</a>';
        echo '</div>';
      }
    } else {
      echo "<p>Aucun voyage trouvé pour le moment.</p>";
    }
    ?>

  </div>
</section>

<?php include('includes/footer.php'); ?>
