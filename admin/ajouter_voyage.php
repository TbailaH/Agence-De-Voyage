<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre = $_POST['titre'];
  $destination = $_POST['destination'];
  $description = $_POST['description'];
  $date_depart = $_POST['date_depart'];
  $date_retour = $_POST['date_retour'];
  $prix = floatval($_POST['prix']);
  $places = intval($_POST['places_disponibles']);

  // Gestion image
  $imageName = '';
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageName = basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $imageName);
  }

  $stmt = $conn->prepare("INSERT INTO voyage (titre, destination, description, date_depart, date_retour, prix, places_disponibles, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssdss", $titre, $destination, $description, $date_depart, $date_retour, $prix, $places, $imageName);

  if ($stmt->execute()) {
    $success = "Voyage ajouté avec succès.";
  } else {
    $error = "Erreur lors de l'ajout du voyage: " . $conn->error;
  }
}

include('../includes/header.php');
?>

<section class="admin-form-page">
  <h2>Ajouter un voyage</h2>

  <?php if ($success): ?><p style="color:green;"><?php echo $success; ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data" class="admin-form">
    <label>Titre :</label>
    <input type="text" name="titre" required>

    <label>Destination :</label>
    <input type="text" name="destination" required>

    <label>Description :</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Date de départ :</label>
    <input type="date" name="date_depart" required>

    <label>Date de retour :</label>
    <input type="date" name="date_retour" required>

    <label>Prix :</label>
    <input type="number" name="prix" step="0.01" required>

    <label>Places disponibles :</label>
    <input type="number" name="places_disponibles" required>

    <label>Image :</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn">Ajouter le voyage</button>
  </form>
</section>


