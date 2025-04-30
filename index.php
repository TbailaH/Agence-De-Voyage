<?php
session_start();
include('includes/db.php');
include('includes/header.php');
?>

<!-- BANNIÈRE -->
<section class="banner">
    <h1>Bienvenue chez Voyages Maroc</h1>
    <p>Explorez les meilleures destinations avec nous !</p>
    <a href="voyages.php" class="btn">Voir les voyages</a>
</section>

<!-- VOYAGES EN VEDETTE -->
<section class="featured">
    <h2>Nos voyages organisés</h2>
    <div class="cards">

        <?php
    $query = "SELECT * FROM voyage ORDER BY date_depart ASC LIMIT 3";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="images/' . $row['image'] . '" alt="' . $row['destination'] . '">';
        echo '<h3>' . $row['titre'] . '</h3>';
        echo '<p>À partir de ' . $row['prix'] . ' DH</p>';
        echo '<a href="details.php?id=' . $row['id'] . '">Détails</a>';
        echo '</div>';
      }
    } else {
      echo '<p>Aucun voyage disponible pour le moment.</p>';
    }
    ?>

    </div>
</section>

<?php include('includes/footer.php'); ?>