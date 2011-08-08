<div class="wrap">
  <h2>Cordon</h2>

  <form action="options.php" method="post">
    <?php settings_fields('cordon'); ?>
    <?php do_settings_sections('cordon'); ?>

    <p class="submit">
      <input type="submit" class="button-primay" valud="Save Changes" />
    </p>
  </form>
</div>
