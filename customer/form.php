<?php
include_once __DIR__ . "/customer.php";

$db = new Database();
$db->connect();

$customer = new Customer($db);
$groups = $customer->getGroups($db);

if (isset($_GET['id'])) {
    $customer->load($_GET['id']);
}

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><?= $customer->value('customer_id') ? 'Edit' : 'New' ?> Customer</h3>
    <a href="list.php" class="btn btn-outline-secondary">Go Back</a>
</div>

<div class="card shadow-sm border-0 rounded-3 p-4 bg-white">
    <form action="save.php" method="POST">
        <?php if ($customer->value('customer_id')): ?>
            <input type="hidden" name="customer_id" value="<?= $customer->value('customer_id') ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">First Name</label>
                <input type="text" name="first_name" class="form-control" 
                       value="<?= htmlspecialchars($customer->value('first_name') ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Last Name</label>
                <input type="text" name="last_name" class="form-control" 
                       value="<?= htmlspecialchars($customer->value('last_name') ?? '') ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Email Address</label>
                <input type="email" name="email" class="form-control" 
                       value="<?= htmlspecialchars($customer->value('email') ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Phone Number</label>
                <input type="text" name="phone" class="form-control" 
                       value="<?= htmlspecialchars($customer->value('phone') ?? '') ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Customer Group</label>
                <select name="customer_group_id" class="form-select" required>
                    <option value="">Select Group</option>
                    <?php if ($groups): ?>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['customer_group_id'] ?>" 
                                <?= $customer->value('customer_group_id') == $group['customer_group_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($group['group_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Status</label>
                <select name="status" class="form-select">
                    <option value="1" <?= $customer->value('status') == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $customer->value('status') == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Save Customer</button>
            <a href="list.php" class="btn btn-light px-4">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
