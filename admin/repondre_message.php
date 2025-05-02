<?php
session_start();
$admin = true;
include('../includes/db.php');
include('../includes/auth.php');

if ($_SESSION['user_role'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

// جلب الرسالة
$stmt = $conn->prepare("SELECT * FROM message_contact WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$message = $res->fetch_assoc();

if (!$message) {
  die("Message introuvable.");
}

// معالجة الرد
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reponse = $_POST['reponse'];
  $stmt = $conn->prepare("UPDATE message_contact SET reponse_admin = ?, statut = 'répondu' WHERE id = ?");
  $stmt->bind_param("si", $reponse, $id);
  if ($stmt->execute()) {
    $success = "Réponse envoyée avec succès.";
  } else {
    $error = "Erreur lors de la réponse.";
  }
}

include('../includes/header.php');
?>

<section class="admin-form-page">
  <h2>Répondre au message</h2>

  <?php if ($success): ?><p style="color:green;"><?php echo $success; ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>

  <div class="message-details">
    <p><strong>Nom :</strong> <?php echo htmlspecialchars($message['nom']); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($message['email']); ?></p>
    <p><strong>Sujet :</strong> <?php echo htmlspecialchars($message['sujet']); ?></p>
    <p><strong>Message :</strong><br><?php echo nl2br(htmlspecialchars($message['contenu'])); ?></p>
  </div>

  <form action="" method="post" class="admin-form">
    <label>Votre réponse :</label>
    <textarea name="reponse" rows="5" required><?php echo htmlspecialchars($message['reponse_admin'] ?? ''); ?></textarea>
    <button type="submit" class="btn">Envoyer la réponse</button>
  </form>
</section>


