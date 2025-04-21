<?php
include('includes/db.php');
$erreur = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $pays = $_POST['pays'];
  $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // hash mot de passe

  // Vérification si email déjà utilisé
  $check = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $erreur = "Cet email est déjà utilisé.";
  } else {
    // Insertion
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

<?php include('includes/header.php'); ?>

<section class="register-page">
  <h2>Créer un compte</h2>

  <?php if ($erreur): ?>
    <p style="color:red;"><?php echo $erreur; ?></p>
  <?php endif; ?>

  <?php if ($success): ?>
    <p style="color:green;"><?php echo $success; ?></p>
  <?php else: ?>
  <form action="" method="post" class="register-form">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required>

    <label for="email">Email :</label>
    <input type="email" name="email" required>

    <label for="telephone">Téléphone :</label>
    <input type="text" name="telephone" required>

    <label for="pays">Pays :</label>
    <input type="text" name="pays" required>

    <label for="motdepasse">Mot de passe :</label>
    <input type="password" name="motdepasse" required>

    <button type="submit" class="btn">S'inscrire</button>

    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
  </form>
  <?php endif; ?>
</section>

<?php include('includes/footer.php'); ?>
