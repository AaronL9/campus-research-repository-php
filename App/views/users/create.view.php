<?= loadPartial('head') ?>

<main class="auth">
  <img src="/images/upang-logo.png" alt="logo">
  <h1>campus research repository</h1>

  <form action="/register" method="POST">
    <label id="name-label">Name:</label>
    <div class="name">
      <input aria-labelledby="name-label" id="first-name" name="first_name" type="text" placeholder="Enter your first name" value="<?= $user['firstName'] ?? '' ?>">
      <input aria-labelledby="name-label" id="last-name" name="last_name" type="text" placeholder="Enter your last name" value="<?= $user['lastName'] ?? '' ?>">
    </div>

    <label for="email">Email</label>
    <input id="email" type="text" name="email" placeholder="Enter your email" value="<?= $user['email'] ?? '' ?>">

    <label for="password">Password</label>
    <input id="password" type="password" placeholder="Enter your password" name="password">

    <label for="password_confirmation">Confirm Password</label>
    <input id="password_confirmation" type="password" placeholder="Confirm password" name="password_confirmation">

    <button class="auth-button">Register</button>

    <p class="register-link">
      Already have an account? <a href="/login">Login</a>
    </p>
  </form>
</main>

<?= loadPartial('footer') ?>