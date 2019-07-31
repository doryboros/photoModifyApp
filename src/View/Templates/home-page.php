
<?php echo "home page";?>
    <div class="container">
    <?php foreach ($products as $product): ?>

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $product->getThumbnailPath() ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">
                       Product title: <?= $product->getTitle() ?>
                </h5>
                <p class="card-text">
                    Product description:  <?= $product->getDescription() ?>
                </p>
                <a href="product/id/<?php echo $product->getId() ?>" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

    <?php endforeach ?>
    </div>


