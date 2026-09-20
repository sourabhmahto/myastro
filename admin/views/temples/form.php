<?php
/**
 * Admin Temple Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $temple ? 'Edit Temple' : 'Add New Temple' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=temples') ?>" class="btn-admin-secondary">
            &larr; Back to Temples
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-bank2"></i> <?= $temple ? 'Edit Temple Details' : 'Temple Information' ?>
            </div>
            <div class="form-card-body">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
                <?php endif; ?>

                <form action="<?= url('admin?action=temple_form' . ($temple ? '&id=' . $temple['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="form-name-input" class="form-label-admin">Temple / Shrine Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="form-name-input" name="name" required value="<?= e($temple['name'] ?? '') ?>" placeholder="e.g. Shree Omkareshwar Jyotirlinga Temple">
                        </div>
                        <div class="col-md-4">
                            <label for="form-slug-input" class="form-label-admin">URL Slug</label>
                            <input type="text" class="form-control-admin" id="form-slug-input" name="slug" value="<?= e($temple['slug'] ?? '') ?>" placeholder="omkareshwar-jyotirlinga-temple">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label-admin">Short Summary (Brief snippet for cards) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-admin" id="short_description" name="short_description" required value="<?= e($temple['short_description'] ?? '') ?>" placeholder="Brief 1-2 sentence description...">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label-admin">Full Temple History &amp; Sanctum Description <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="description" name="description" rows="6" required placeholder="Detailed historical lore, architecture, and rituals..."><?= e($temple['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label-admin">Address / Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-admin" id="address" name="address" required value="<?= e($temple['address'] ?? 'Mandhata Island, Omkareshwar, MP - 450554') ?>">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="opening_time" class="form-label-admin">Daily Opening Time</label>
                            <input type="time" class="form-control-admin" id="opening_time" name="opening_time" value="<?= e($temple['opening_time'] ?? '05:00:00') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="closing_time" class="form-label-admin">Daily Closing Time</label>
                            <input type="time" class="form-control-admin" id="closing_time" name="closing_time" value="<?= e($temple['closing_time'] ?? '21:30:00') ?>">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="latitude" class="form-label-admin">Latitude (Optional)</label>
                            <input type="text" class="form-control-admin" id="latitude" name="latitude" value="<?= e($temple['latitude'] ?? '') ?>" placeholder="22.2464199">
                        </div>
                        <div class="col-md-6">
                            <label for="longitude" class="form-label-admin">Longitude (Optional)</label>
                            <input type="text" class="form-control-admin" id="longitude" name="longitude" value="<?= e($temple['longitude'] ?? '') ?>" placeholder="76.1506000">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Featured Temple Image</label>
                            <input type="file" class="form-control-admin" name="featured_image" accept="image/*" data-preview="temple-img-preview">
                            <div class="image-preview-box mt-2" id="temple-img-preview">
                                <?php if (!empty($temple['featured_image'])): ?>
                                <img src="<?= e(upload_url($temple['featured_image'], 'default-temple.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="active" <?= (($temple['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active (Published)</option>
                                <option value="inactive" <?= (($temple['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=temples') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $temple ? 'Save Changes' : 'Create Temple Record' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
