<?php if (!isset($data) || !is_array($data) || !isset($data['product'])): return; endif; ?>
<?php $product = $data['product']; ?>

<?php echo $product->getId(); ?>

<div class="container">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= $product->getThumbnailPath() ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                Product title: <?= $product->getTitle() ?>
            </h5>
            <p class="card-text">
                Product description:  <?= $product->getDescription() ?>
            </p>
        </div>
    </div>
</div>
