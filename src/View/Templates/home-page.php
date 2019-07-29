
        <?php echo "home page";?>

        <ul>
            <?php foreach ($products as $product): ?>
                <li><a href="product/<?php echo $product->getId() ?>">Product name: <?= $product->getTitle() ?></a></li>
            <?php endforeach ?>
        </ul>
