<?php if (!isset($data) || !is_array($data) || !isset($data['product'])): return; endif; ?>
<?php
    $product = $data['product'];
    $tiers = $data['tiers'];
    $tier=$tiers[1];
?>

<div class="container">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/<?= $tier->getPathWithWatermark()?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                Product title: <?= $product->getTitle() ?>
            </h5>
            <p class="card-text">
                Product description:  <?= $product->getDescription() ?>
            </p>
            <p class="card-text">
                Product description:  <?= $product->getCameraSpecs() ?>
            </p>
        </div>
    </div>
</div></br>


<div class="container">
    <?php foreach ($tiers as $tier): ?>

            <img src="/<?= $tier->getPathWithWatermark()?>" alt="Card image cap">
            <span><?= $tier->getPrice();?> LEI</span>
            <button><a href="/downloadPhoto/id/<?=$tier->getId() ?>">Buy</a></button>

    <?php endforeach ?>
</div>


