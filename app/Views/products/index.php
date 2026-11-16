<?php use App\Core\View; use App\Core\CurrencyApi; ?>
<h1 class="section-title">All Gear</h1>

<div class="filters">
    <a href="<?= $baseUrl ?>/products" class="chip <?= $active ? '' : 'chip-active' ?>">All</a>
    <?php foreach ($categories as $c): ?>
        <a href="<?= $baseUrl ?>/products?category=<?= urlencode($c) ?>"
           class="chip <?= $active === $c ? 'chip-active' : '' ?>"><?= View::e($c) ?></a>
    <?php endforeach; ?>
</div>

<div class="grid">
    <?php foreach ($products as $p): ?>
        <div class="card">
            <div class="card-img"><img src="<?= View::e($p['image']) ?>" alt="<?= View::e($p['name']) ?>" loading="lazy" onerror="this.src='<?= $baseUrl ?>/images/placeholder.svg'"></div>
            <div class="card-body">
                <span class="tag"><?= View::e($p['category']) ?></span>
                <h3><a href="<?= $baseUrl ?>/products/<?= $p['id'] ?>"><?= View::e($p['name']) ?></a></h3>
                <p class="price"><?= CurrencyApi::format((float) $p['price']) ?></p>
                <form method="POST" action="<?= $baseUrl ?>/cart/add">
                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                    <button class="btn btn-small" type="submit">Add to Cart</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
