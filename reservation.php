<?php include('includes/header.php'); ?>

<section class="reservation-page">
  <h2>Réserver votre voyage</h2>

  <div class="reservation-container">
    <!-- Détails du voyage -->
    <div class="voyage-info">
      <h3>Marrakech - 3 jours / 2 nuits</h3>
      <p><strong>Destination :</strong> Marrakech</p>
      <p><strong>Prix :</strong> 1200 DH / personne</p>
    </div>

    <!-- Formulaire de réservation -->
    <form action="confirmation.php" method="post" class="reservation-form">
      <label>Nom complet :</label>
      <input type="text" name="nom" required>

      <label>Téléphone :</label>
      <input type="text" name="telephone" required>

      <label>Nombre de personnes :</label>
      <input type="number" name="nombre_personnes" min="1" required>

      <label>Options supplémentaires :</label>
      <textarea name="options" rows="3" placeholder="Hôtel 5*, repas, guide..."></textarea>

      <button type="submit" class="btn">Confirmer la réservation</button>
    </form>
  </div>
</section>

<?php include('includes/footer.php'); ?>
