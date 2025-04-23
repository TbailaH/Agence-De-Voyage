<?php
session_start();
include('includes/db.php');
include('includes/header.php');

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $motdepasse = $_POST['motdepasse'];

  $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($motdepasse, $user['motdepasse'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_nom'] = $user['nom'];
      $_SESSION['user_role'] = $user['role'];

      if ($user['role'] == 'admin') {
        header("Location: admin/dashboard.php");
      } else {
        header("Location: index.php");
      }
      exit;
    } else {
      $erreur = "Mot de passe incorrect.";
    }
  } else {
    $erreur = "Email non trouvé.";
  }
}
?>

<section class="login-page">
  <h2>Connexion</h2>

  <?php if ($erreur): ?>
    <p style="color:red;"><?php echo $erreur; ?></p>
  <?php endif; ?>

  <form action="" method="post" class="login-form">
    <label for="email">Email :</label>
    <input type="email" name="email" required>

    <label for="motdepasse">Mot de passe :</label>
    <input type="password" name="motdepasse" required>

    <button type="submit" class="btn">Se connecter</button>

    <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
  </form>
</section>

<?php include('includes/footer.php'); ?>
