<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-info" role="alert">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php elseif (session()->getFlashdata('warning')) : ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashdata('warning'); ?>
            </div>
        <?php endif; ?>
        <form action="">
            <div class="col-md-6 mx-auto">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>

    <a href="<?= route_to('post.new'); ?>" class="btn btn-primary mb-2">Tambah Data</a>
    <?php if (count($posts)) : ?>
        <div class="row">

            <?php foreach ($posts as $post) : ?>
                <div class="col-md-4">
                    <div class="card flex-fill">
                        <img src="<?= $post['image'] ? '/img/' . $post['image'] : '/img/default.jpg" class="card-img-top'; ?>" alt="...">
                        <div class="card-body">
                            <h3><?= $post['title']; ?></h3>
                            <p class="card-text"><?= word_limiter($post['body'], 30); ?></p>
                            <a href="<?= route_to('post.show', $post['slug']); ?>" class="d-flex justify-content-end">Read More></a>
                            <p></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?= $pager->links('posts', 'default') ?>
        </div>
    <?php else : ?>
        <h1>
            Not Found
        </h1>
    <?php endif; ?>
</div>

<?= $this->endSection();  ?>