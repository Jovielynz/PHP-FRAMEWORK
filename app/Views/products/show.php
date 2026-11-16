<?php use App\Core\View; use App\Core\CurrencyApi; ?>
<a href="<?= $baseUrl ?>/products" class="back">← Back to shop</a>
<div class="product-detail">
    <div class="product-detail-img"><img src="<?= View::e($product['image']) ?>" alt="<?= View::e($product['name']) ?>" onerror="this.src='<?= $baseUrl ?>/images/placeholder.svg'"></div>
    <div>
        <span class="tag"><?= View::e($product['category']) ?></span>
        <h1><?= View::e($product['name']) ?></h1>
        <p class="price price-lg"><?= CurrencyApi::format((float) $product['price']) ?></p>
        <p><?= View::e($product['description']) ?></p>
        <p class="muted">In stock: <?= (int) $product['stock'] ?></p>
        <form method="POST" action="<?= $baseUrl ?>/cart/add" class="inline-form">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <label>Qty <input type="number" name="qty" value="1" min="1" max="<?= (int) $product['stock'] ?>"></label>
            <button class="btn" type="submit">Add to Cart</button>
        </form>
    </div>
</div>
