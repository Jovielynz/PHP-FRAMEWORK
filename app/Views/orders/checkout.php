<?php use App\Core\View; use App\Core\CurrencyApi; ?>
<h1 class="section-title">Checkout</h1>
<div class="checkout">
    <div class="form-card">
        <h2>Delivery details</h2>
        <form method="POST" action="<?= $baseUrl ?>/checkout" data-validate>
            <label>Name <input type="text" value="<?= View::e($user['name']) ?>" disabled></label>
            <label>Delivery address <textarea name="address" rows="3" required></textarea></label>
            <p class="muted small">Payment: Cash on Delivery</p>
            <button class="btn btn-block" type="submit">Place Order</button>
        </form>
    </div>
    <div class="summary">
        <h2>Order summary</h2>
        <?php $total = 0; foreach ($cart as $item): $sub = $item['price'] * $item['qty']; $total += $sub; ?>
            <p><?= View::e($item['name']) ?> × <?= $item['qty'] ?> <span>₱<?= number_format($sub, 2) ?></span></p>
        <?php endforeach; ?>
        <p class="total">Total <span><?= CurrencyApi::format($total) ?></span></p>
    </div>
</div>
