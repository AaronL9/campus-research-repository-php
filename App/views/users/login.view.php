<?= loadPartial('head') ?>

<main class="auth">
  <img src="/images/upang-logo.png" alt="logo">
  <h1>campus research repository</h1>

  <form action="/login" method="POST">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" placeholder="Enter your email">

    <label for="password">Password</label>
    <input id="password" type="password" name="password" placeholder="Enter your password">

    <button>Login</button>
    <a class="forgot-password" href="/">Forgot password?</a>

    <p class="register-link">
      Don't have an account? <a href="/register">Register</a>
    </p>
  </form>
</main>

<?= loadPartial('footer') ?>