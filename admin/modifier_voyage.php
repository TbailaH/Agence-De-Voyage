<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

// تأكد أن المستخدم admin
if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

// جلب بيانات الرحلة
$stmt = $conn->prepare("SELECT * FROM voyage WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$voyage = $result->fetch_assoc();

if (!$voyage) {
  die("Voyage introuvable.");
}

// تحديث البيانات بعد التعديل
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre = $_POST['titre'];
  $destination = $_POST['destination'];
  $description = $_POST['description'];
  $date_depart = $_POST['date_depart'];
  $date_retour = $_POST['date_retour'];
  $prix = $_POST['prix'];
  $places = $_POST['places_disponibles'];

  $stmt = $conn->prepare("UPDATE voyage SET titre=?, destination=?, description=?, date_depart=?, date_retour=?, prix=?, places_disponibles=? WHERE id=?");
  $stmt->bind_param("sssssdii", $titre, $destination, $description, $date_depart, $date_retour, $prix, $places, $id);

  if ($stmt->execute()) {
    $success = "Voyage mis à jour avec succès.";
  } else {
    $error = "Erreur lors de la mise à jour.";
  }
}

include('../includes/header.php');
?>

<section class="admin-form-page">
  <h2>Modifier le voyage</h2>

  <?php if ($success): ?><p style="color:green;"><?php echo $success; ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>

  <form action="" method="post" class="admin-form">
    <label>Titre :</label>
    <input type="text" name="titre" value="<?php echo htmlspecialchars($voyage['titre']); ?>" required>

    <label>Destination :</label>
    <input type="text" name="destination" value="<?php echo htmlspecialchars($voyage['destination']); ?>" required>

    <label>Description :</label>
    <textarea name="description" rows="4" required><?php echo htmlspecialchars($voyage['description']); ?></textarea>

    <label>Date départ :</label>
    <input type="date" name="date_depart" value="<?php echo $voyage['date_depart']; ?>" required>

    <label>Date retour :</label>
    <input type="date" name="date_retour" value="<?php echo $voyage['date_retour']; ?>" required>

    <label>Prix :</label>
    <input type="number" name="prix" value="<?php echo $voyage['prix']; ?>" step="0.01" required>

    <label>Places disponibles :</label>
    <input type="number" name="places_disponibles" value="<?php echo $voyage['places_disponibles']; ?>" required>

    <button type="submit" class="btn">Mettre à jour</button>
  </form>
</section>


