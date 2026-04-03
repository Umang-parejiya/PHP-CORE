<?php
include_once __DIR__ . "/customer.php";

$db = new Database(); // Uses new defaults: localhost, root, "", internship_project, 3307
$db->connect();

$query = "SELECT c.*, cg.group_name 
          FROM customer c 
          LEFT JOIN customer_group cg ON c.customer_group_id = cg.customer_group_id 
          ORDER BY c.customer_id DESC";
$customers = $db->fetchAll($query);

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customers</h3>
    <a href="form.php" class="btn btn-primary">Add New Customer</a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th width="150" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($customers): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= $customer['customer_id'] ?></td>
                            <td class="fw-medium"><?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></td>
                            <td><?= htmlspecialchars($customer['email']) ?></td>
                            <td><?= htmlspecialchars($customer['phone']) ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($customer['group_name'] ?? 'None') ?></span></td>
                            <td>
                                <?php if ($customer['status']): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="form.php?id=<?= $customer['customer_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="delete.php" method="POST" class="d-inline" onsubmit="return confirm('Delete this customer?');">
                                    <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No customers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
