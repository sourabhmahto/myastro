<?php
/**
 * Admin Devotees & Staff Management View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Devotees &amp; Administrators</h2>
    </div>
</div>

<div class="row g-4">
    <!-- Administrators List & Add Admin Form -->
    <div class="col-lg-5">
        <div class="admin-table-card mb-4">
            <div class="card-header">
                <h5>Administrators</h5>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($admins)): foreach ($admins as $a): ?>
                        <tr>
                            <td><strong><?= e($a['name']) ?></strong></td>
                            <td><small><?= e($a['email']) ?></small></td>
                            <td><span class="badge bg-crimson text-white"><?= e($a['role']) ?></span></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-person-plus-fill"></i> Add Administrator
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=users') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="add_admin">

                    <div class="mb-3">
                        <label class="form-label-admin">Full Name</label>
                        <input type="text" name="name" class="form-control-admin" placeholder="e.g. Pandit Rajesh Shastri" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-admin">Email Address</label>
                        <input type="email" name="email" class="form-control-admin" placeholder="admin@omkareshwar.local" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-admin">Password (Min 6 chars)</label>
                        <input type="password" name="password" class="form-control-admin" placeholder="••••••••" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-admin">Role</label>
                        <select name="role" class="form-select-admin">
                            <option value="manager">Manager / Coordinator</option>
                            <option value="superadmin">Super Administrator</option>
                            <option value="pandit_coordinator">Pandit Coordinator</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-admin-primary w-100">
                        Create Administrator
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Devotees / Customer Accounts -->
    <div class="col-lg-7">
        <div class="admin-table-card">
            <div class="card-header">
                <h5>Registered Devotees (Auto-Created on Booking)</h5>
                <input type="text" class="table-search-input" placeholder="Search devotees...">
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Joined</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><strong><?= e($u['name']) ?></strong></td>
                            <td>
                                <div><i class="bi bi-envelope me-1 text-muted"></i><?= e($u['email']) ?></div>
                                <div><i class="bi bi-telephone me-1 text-muted"></i><?= e($u['phone']) ?></div>
                            </td>
                            <td><small class="text-muted"><?= format_date($u['created_at']) ?></small></td>
                            <td>
                                <span class="status-badge status-<?= e($u['status']) ?>">
                                    <?= e($u['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No devotee accounts recorded yet.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
