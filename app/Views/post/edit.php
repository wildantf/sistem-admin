<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <form action="<?= route_to('post.update', $post['id']); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="slug" value="<?= $post['slug']; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control <?= $validation->hasError('title') ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?= old('title') ?? $post['title']; ?>">
                    <?php if ($validation->hasError('title')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div> -->
                <div class="mb-3 row">
                    <label for="image" class="form-label">Image</label>
                    <div class="col-sm-2">
                        <img src="<?= $post['image'] ? '/img/' . $post['image'] : '/img/default.jpg'; ?>" class="img-thumbnail image-preview" alt="">
                    </div>
                    <div class="col-sm-10">
                        <input type="hidden" name="oldImageName" value="<?= $post['image']; ?>">
                        <input accept=".png, .jpg, .jpeg" class="form-control <?= $validation->hasError('image') ? 'is-invalid' : ''; ?>" type="file" id="image" name="image" onchange="imgPreview()">
                        <?php if ($validation->hasError('image')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('image'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control <?= $validation->hasError('body') ? 'is-invalid' : ''; ?>" id="body" name="body" rows="3"><?= old('body') ?? $post['body']; ?></textarea>
                    <?php if ($validation->hasError('body')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('body'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection();  ?>