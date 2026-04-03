<?php
include_once __DIR__ . "/product_media.php";

$db = new Database();
$db->connect();

$media = new ProductMedia($db);
$products = $media->getProducts($db);

if (isset($_GET['id'])) {
    $media->load($_GET['id']);
}

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><?= $media->value('product_media_id') ? 'Edit' : 'Upload' ?> Media</h3>
    <a href="list.php" class="btn btn-outline-secondary">Go Back</a>
</div>

<div class="card shadow-sm border-0 rounded-3 p-4 bg-white">
    <form action="save.php" method="POST">
        <?php if ($media->value('product_media_id')): ?>
            <input type="hidden" name="product_media_id" value="<?= $media->value('product_media_id') ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label fw-medium">Product</label>
            <select name="product_id" class="form-select" required>
                <option value="">Select Product</option>
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['product_id'] ?>" 
                            <?= $media->value('product_id') == $product['product_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($product['name']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">File Path / URL</label>
            <input type="text" name="file_path" class="form-control" 
                   placeholder="e.g., https://example.com/image.jpg"
                   value="<?= htmlspecialchars($media->value('file_path') ?? '') ?>" required>
            <small class="text-muted">Enter a direct image URL or path.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" 
                   value="<?= htmlspecialchars($media->value('alt_text') ?? '') ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Sort Order</label>
                <input type="number" step="0.01" name="sort_order" class="form-control" 
                       value="<?= $media->value('sort_order') ?? '0.00' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Primary Image</label>
                <select name="is_primary" class="form-select">
                    <option value="1" <?= $media->value('is_primary') == 1 ? 'selected' : '' ?>>Yes</option>
                    <option value="0" <?= $media->value('is_primary') == 0 ? 'selected' : '' ?>>No</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Save Media</button>
            <a href="list.php" class="btn btn-light px-4">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
