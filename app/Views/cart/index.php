<?php use App\Core\View; use App\Core\CurrencyApi; ?>
<h1 class="section-title">Your Cart</h1>

<?php if (empty($cart)): ?>
    <p class="empty">Your cart is empty. <a href="<?= $baseUrl ?>/products">Start shopping →</a></p>
<?php else: ?>
    <?php $total = 0; ?>
    <table class="table">
        <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($cart as $item): $sub = $item['price'] * $item['qty']; $total += $sub; ?>
            <tr>
                <td class="cart-item"><img src="<?= View::e($item['image']) ?>" alt="" class="thumb" onerror="this.src='<?= $baseUrl ?>/images/placeholder.svg'"> <?= View::e($item['name']) ?></td>
                <td>₱<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['qty'] ?></td>
                <td>₱<?= number_format($sub, 2) ?></td>
                <td>
                    <form method="POST" action="<?= $baseUrl ?>/cart/remove">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <button class="btn-link" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot><tr><th colspan="3">Total</th><th colspan="2"><?= CurrencyApi::format($total) ?></th></tr></tfoot>
    </table>
    <div class="actions">
        <a href="<?= $baseUrl ?>/products" class="btn btn-outline">Continue Shopping</a>
        <a href="<?= $baseUrl ?>/checkout" class="btn">Proceed to Checkout</a>
    </div>
<?php endif; ?>
