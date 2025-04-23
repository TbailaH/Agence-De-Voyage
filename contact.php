<?php
session_start();
include('includes/db.php');
include('includes/header.php');

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $sujet = $_POST['sujet'];
  $contenu = $_POST['contenu'];

  $stmt = $conn->prepare("INSERT INTO message_contact (nom, email, sujet, contenu) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $nom, $email, $sujet, $contenu);

  if ($stmt->execute()) {
    $success = "Votre message a bien été envoyé.";
  } else {
    $error = "Erreur lors de l'envoi du message.";
  }
}
?>

<section class="contact-page">
  <h2>Contactez-nous</h2>

  <?php if ($success): ?>
    <p style="color:green;"><?php echo $success; ?></p>
  <?php elseif ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
  <?php endif; ?>

  <form action="" method="post" class="contact-form">
    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Sujet :</label>
    <input type="text" name="sujet" required>

    <label>Message :</label>
    <textarea name="contenu" rows="5" required></textarea>

    <button type="submit" class="btn">Envoyer</button>
  </form>
</section>

<?php include('includes/footer.php'); ?>
