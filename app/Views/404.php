<?php use App\Core\View; ?>
<div class="form-card center">
    <h1>404 — Respawn?</h1>
    <p><?= View::e($message ?? 'Page not found.') ?></p>
    <a href="<?= $baseUrl ?>/" class="btn">Back to Base</a>
</div>
