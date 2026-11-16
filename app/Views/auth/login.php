<div class="form-card">
    <h1>Welcome back, player</h1>
    <form method="POST" action="<?= $baseUrl ?>/login" data-validate>
        <label>Email <input type="email" name="email" required></label>
        <label>Password <input type="password" name="password" required></label>
        <button class="btn btn-block" type="submit">Login</button>
    </form>
    <p class="muted">No account? <a href="<?= $baseUrl ?>/register">Sign up</a></p>
    <p class="muted small">Demo: demo@neonloot.com / password123</p>
</div>
