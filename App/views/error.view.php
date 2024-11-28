<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<section>
  <div class="error">
    <h1>
      <?= $status ?>
    </h1>
    <p>
      <?= $message ?>
    </p>
    <a class="block text-center" href="/">Go Back To Home</a>
  </div>
</section>

<?= loadPartial('footer') ?>