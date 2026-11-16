<?php use App\Core\View; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= View::e($title ?? 'NeonLoot') ?> | NeonLoot</title>
    <link rel="icon" href="<?= $baseUrl ?>/images/logo.svg">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/style.css">
</head>
<body>
<header class="navbar">
    <a href="<?= $baseUrl ?>/" class="logo"><img src="<?= $baseUrl ?>/images/logo.svg" alt="" class="logo-icon"><span class="logo-text">Neon<span>Loot</span></span></a>
    <nav>
        <a href="<?= $baseUrl ?>/">Home</a>
        <a href="<?= $baseUrl ?>/products">Shop</a>
        <a href="<?= $baseUrl ?>/cart">Cart <span class="badge"><?= $cartCount ?></span></a>
        <?php if ($user): ?>
            <a href="<?= $baseUrl ?>/orders">My Orders</a>
            <a href="<?= $baseUrl ?>/logout">Logout (<?= View::e($user['name']) ?>)</a>
        <?php else: ?>
            <a href="<?= $baseUrl ?>/login">Login</a>
            <a href="<?= $baseUrl ?>/register" class="btn btn-small">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php if ($flash): ?>
        <div class="flash flash-<?= View::e($flash['type']) ?>" id="flash"><?= View::e($flash['message']) ?></div>
    <?php endif; ?>

    <?= $content ?>
</main>

<footer class="footer">
    <p>© <?= date('Y') ?> NeonLoot — Gear up. Level up. Built with a custom PHP framework.</p>
</footer>

<script src="<?= $baseUrl ?>/js/app.js"></script>
</body>
</html>
