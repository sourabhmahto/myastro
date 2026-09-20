<?php
/**
 * Admin Contact Inquiries Inbox View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Contact Inquiries Inbox <span>(<?= count($messages) ?> inquiries)</span></h2>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Devotee Inquiries &amp; Assistance Requests</h5>
        <input type="text" class="table-search-input" placeholder="Search inquiries...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Devotee Name</th>
                    <th>Contact Info</th>
                    <th>Message Snippet</th>
                    <th>Received Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): foreach ($messages as $m): ?>
                <tr class="<?= ($m['status'] === 'unread') ? 'bg-light fw-semibold' : '' ?>">
                    <td><?= $m['id'] ?></td>
                    <td><strong><?= e($m['name']) ?></strong></td>
                    <td>
                        <a href="mailto:<?= e($m['email']) ?>" class="text-decoration-none d-block text-slate"><i class="bi bi-envelope me-1"></i><?= e($m['email']) ?></a>
                        <a href="tel:<?= e($m['phone']) ?>" class="text-decoration-none d-block text-slate"><i class="bi bi-telephone me-1"></i><?= e($m['phone']) ?></a>
                    </td>
                    <td>
                        <div style="max-width:320px;"><?= e($m['message']) ?></div>
                    </td>
                    <td><small class="text-muted"><?= format_date($m['created_at'], 'd M Y, h:i A') ?></small></td>
                    <td>
                        <span class="status-badge status-<?= e($m['status']) ?>">
                            <?= e($m['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="mailto:<?= e($m['email']) ?>?subject=Re:%20Omkareshwar%20Jyotirlinga%20Seva%20Inquiry" class="btn-action btn-view" title="Reply via Email">
                                <i class="bi bi-reply-fill"></i>
                            </a>
                            <?php if ($m['status'] === 'unread'): ?>
                            <a href="<?= url('admin?action=messages&action_type=status&set=read&id=' . $m['id']) ?>" class="btn-action btn-edit" title="Mark as Read">
                                <i class="bi bi-check2"></i>
                            </a>
                            <?php else: ?>
                            <a href="<?= url('admin?action=messages&action_type=status&set=unread&id=' . $m['id']) ?>" class="btn-action" style="background:#F1F5F9;" title="Mark as Unread">
                                <i class="bi bi-envelope"></i>
                            </a>
                            <?php endif; ?>
                            <a href="<?= url('admin?action=messages&action=delete&id=' . $m['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this inquiry?" title="Delete Message">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No messages received yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
