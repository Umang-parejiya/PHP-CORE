<?php
include_once __DIR__ . "/product_media.php";

$db = new Database();
$db->connect();

$query = "SELECT pm.*, p.name as product_name 
          FROM product_media pm 
          LEFT JOIN product p ON pm.product_id = p.product_id 
          ORDER BY pm.product_media_id DESC";
$media_items = $db->fetchAll($query);

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Product Media</h3>
    <a href="form.php" class="btn btn-primary">Upload New Media</a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th width="100">Preview</th>
                    <th>Product</th>
                    <th>File Path</th>
                    <th>Sort Order</th>
                    <th>Primary</th>
                    <th width="150" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($media_items): ?>
                    <?php foreach ($media_items as $item): ?>
                        <tr>
                            <td><?= $item['product_media_id'] ?></td>
                            <td>
                                <?php if ($item['file_path']): ?>
                                    <img src="<?= htmlspecialchars($item['file_path']) ?>" 
                                         alt="<?= htmlspecialchars($item['alt_text'] ?? 'Preview') ?>" 
                                         class="rounded-2" style="width: 60px; height: 60px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded-2 text-center text-muted" 
                                         style="width: 60px; height: 60px; line-height: 60px;">No Image</div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-medium"><?= htmlspecialchars($item['product_name'] ?? 'Unassigned') ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($item['file_path']) ?></td>
                            <td><?= $item['sort_order'] ?></td>
                            <td>
                                <?php if ($item['is_primary']): ?>
                                    <span class="badge bg-warning text-dark">Primary</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted">Secondary</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="form.php?id=<?= $item['product_media_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="delete.php" method="POST" class="d-inline" onsubmit="return confirm('Delete this media item?');">
                                    <input type="hidden" name="product_media_id" value="<?= $item['product_media_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No media items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
