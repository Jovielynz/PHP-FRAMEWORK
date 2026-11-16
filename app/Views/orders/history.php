<?php use App\Core\View; ?>
<h1 class="section-title">My Orders</h1>
<?php if (empty($orders)): ?>
    <p class="empty">No orders yet. <a href="<?= $baseUrl ?>/products">Shop now →</a></p>
<?php else: ?>
<table class="table">
    <thead><tr><th>Order #</th><th>Date</th><th>Address</th><th>Total</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($orders as $o): ?>
        <tr>
            <td>#<?= $o['id'] ?></td>
            <td><?= View::e($o['created_at']) ?></td>
            <td><?= View::e($o['address']) ?></td>
            <td>₱<?= number_format($o['total'], 2) ?></td>
            <td><span class="tag"><?= View::e($o['status']) ?></span></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
