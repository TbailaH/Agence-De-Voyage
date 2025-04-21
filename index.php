<?php include('includes/header.php'); ?>

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
    <div class="card">
      <img src="images/marrakech.jpg" alt="Marrakech">
      <h3>Marrakech - 3 jours</h3>
      <p>À partir de 1200 DH</p>
      <a href="details.php?id=1">Détails</a>
    </div>
    <div class="card">
      <img src="images/chefchaouen.jpg" alt="Chefchaouen">
      <h3>Chefchaouen - 2 jours</h3>
      <p>À partir de 950 DH</p>
      <a href="details.php?id=2">Détails</a>
    </div>
    <!-- tu peux ajouter d'autres cartes ici -->
  </div>
</section>

<?php include('includes/footer.php'); ?>

