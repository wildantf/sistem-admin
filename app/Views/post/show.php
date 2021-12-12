<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <form action="<?= route_to('post.delete', $post['slug']); ?>" method="post" class="d-inline">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE" />
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="<?= route_to('post.edit', $post['slug']); ?>" class="btn btn-primary">Edit</a>
    <div class="card flex-fill">
        <img src="https://dummyimage.com/600x400/bfbfbf/ffffff&text=No+Image" class="card-img-top" alt="...">
        <div class="card-body">
            <h3><?= $post['title']; ?></h3>
            <p class="card-text"><?= $post['body']; ?></p>
            <a href="<?= route_to('post.show', $post['slug']); ?>" class="d-flex justify-content-end">Read More></a>
        </div>
    </div>
</div>

<?= $this->endSection();  ?>