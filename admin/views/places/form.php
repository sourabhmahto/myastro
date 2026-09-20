<?php
/**
 * Admin Place Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $place ? 'Edit Place' : 'Add New Place' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=places') ?>" class="btn-admin-secondary">
            &larr; Back to Places
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-geo-alt-fill"></i> <?= $place ? 'Edit Place Details' : 'Place Information' ?>
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=place_form' . ($place ? '&id=' . $place['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="form-name-input" class="form-label-admin">Place / Attraction Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="form-name-input" name="name" required value="<?= e($place['name'] ?? '') ?>" placeholder="e.g. Mandhata Island Om Parikrama">
                        </div>
                        <div class="col-md-4">
                            <label for="form-slug-input" class="form-label-admin">URL Slug</label>
                            <input type="text" class="form-control-admin" id="form-slug-input" name="slug" value="<?= e($place['slug'] ?? '') ?>" placeholder="mandhata-island-om-parikrama">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="location" class="form-label-admin">Location Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="location" name="location" required value="<?= e($place['location'] ?? 'Mandhata Island, Omkareshwar') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="distance_from_temple" class="form-label-admin">Distance from Temple <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="distance_from_temple" name="distance_from_temple" required value="<?= e($place['distance_from_temple'] ?? 'Nearby') ?>" placeholder="e.g. 500 meters / 1.5 km">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label-admin">Description &amp; Significance <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="description" name="description" rows="6" required placeholder="Describe the place, scenic views, spiritual significance, and how to reach..."><?= e($place['description'] ?? '') ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Place Image</label>
                            <input type="file" class="form-control-admin" name="image" accept="image/*" data-preview="place-img-preview">
                            <div class="image-preview-box mt-2" id="place-img-preview">
                                <?php if (!empty($place['image'])): ?>
                                <img src="<?= e(upload_url($place['image'], 'default-place.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="active" <?= (($place['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active (Published)</option>
                                <option value="inactive" <?= (($place['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=places') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $place ? 'Save Changes' : 'Create Place' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
