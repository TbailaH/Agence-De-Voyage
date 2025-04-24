<?php $prefix = isset($admin) ? '../' : ''; ?>

<style>
.site-footer {
  background-color: #f8f9fa;
  padding: 20px 0;
  border-top: 1px solid #ddd;
  text-align: center;
  font-size: 14px;
  color: #333;
}

.site-footer a {
  color: #007bff;
  text-decoration: none;
  margin: 0 5px;
}

.site-footer a:hover {
  text-decoration: underline;
}
</style>

<footer class="site-footer">
  <div class="footer-content">
    <p>&copy; 2025 Voyages Maroc. Tous droits réservés.</p>
    <p>
      <a href="<?php echo $prefix; ?>contact.php">Contact</a> |
      <a href="<?php echo $prefix; ?>apropos.php">À propos</a> |
      <a href="#">Mentions légales</a>
    </p>
  </div>
</footer>

</body>
</html>
