<?php
include('includes/db.php');
include('includes/header.php');

$erreur = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $pays = $_POST['pays'];
  $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

  $check = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $erreur = "Cet email est déjà utilisé.";
  } else {
    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, telephone, pays, motdepasse) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $pays, $motdepasse);

    if ($stmt->execute()) {
      $success = "Compte créé avec succès. <a href='login.php'>Se connecter</a>";
    } else {
      $erreur = "Erreur lors de la création du compte.";
    }
  }
}
?>

<section class="register-page">
  <h2>Créer un compte</h2>

  <?php if ($erreur): ?>
    <p style="color:red;"><?php echo $erreur; ?></p>
  <?php endif; ?>

  <?php if ($success): ?>
    <p style="color:green;"><?php echo $success; ?></p>
  <?php else: ?>
  <form action="" method="post" class="register-form">
    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>

    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Téléphone :</label>
    <input type="text" name="telephone" required>

    <label>Pays :</label>
    <input type="text" name="pays" required>

    <label>Mot de passe :</label>
    <input type="password" name="motdepasse" required>

    <button type="submit" class="btn">S'inscrire</button>

    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
  </form>
  <?php endif; ?>
</section>

<?php include('includes/footer.php'); ?>
