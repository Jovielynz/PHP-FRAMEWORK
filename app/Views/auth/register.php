<div class="form-card">
    <h1>Create your account</h1>
    <form method="POST" action="<?= $baseUrl ?>/register" data-validate>
        <label>Full name <input type="text" name="name" required></label>
        <label>Email <input type="email" name="email" required></label>
        <label>Password (min 6) <input type="password" name="password" minlength="6" required></label>
        <button class="btn btn-block" type="submit">Sign Up</button>
    </form>
    <p class="muted">Already registered? <a href="<?= $baseUrl ?>/login">Login</a></p>
</div>
