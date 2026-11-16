<?php use App\Core\View; use App\Core\CurrencyApi; ?>
<section class="hero">
    <div>
        <h1>Level up <span class="rgb-text">your setup.</span></h1>
        <p>Mechanical keyboards, featherweight mice, pro headsets and more — gear built for players who want every frame.</p>
        <a href="<?= $baseUrl ?>/products" class="btn">Shop Gear</a>
    </div>
    <img class="hero-img" src="https://images.pexels.com/photos/28842075/pexels-photo-28842075.jpeg?auto=compress&cs=tinysrgb&w=900"
         alt="RGB gaming setup" onerror="this.style.display='none'">
</section>

<h2 class="section-title">Featured Loot</h2>
<div class="grid">
    <?php foreach ($featured as $p): ?>
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
