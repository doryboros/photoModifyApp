<?php if (!isset($data) || !is_array($data) || !isset($data['product'])): return; endif; ?>
<?php $product = $data['product']; ?>

<?php echo $product->getId(); ?>