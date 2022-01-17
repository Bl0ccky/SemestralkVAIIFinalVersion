<?php /** @var Array $data */ ?>
<div class="container">
    <div class="tourGuyNadpis">Zaujímavé články</div>
    <div class="row text-center mb-5">
        <?php if ($data['message'] != "") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $data['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <?php foreach ($data['blogs'] as $blog) { ?>
        <div class="col-12 col-md-6 col-lg-3">
            <form method="post" action="?c=home&a=specificBlogForm">
                <button type="submit" class="btn oNasText p-1 p-sm-2 p-md-3">
                    <img src="<?= \App\Config\Configuration::BLOG_IMAGE_DIR . $blog->getImage() ?>"
                                     class="img-fluid " alt="blog_img">
                    <?= $blog->getName() ?>
                </button>
                <input name="id_blog" type="hidden" value="<?= $blog->getId(); ?>">
            </form>
        </div>
        <?php } ?>
    </div>
</div>

<div id="slideshow" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="public/images/georgia.jpg" class="d-block w-100" alt="georgia-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/italia.jpg" class="d-block w-100" alt="italy-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/belgium.jpg" class="d-block w-100 obj_position_top" alt="belgium-pic">
        </div>
        <div class="carousel-item">
            <img src="public/images/iran.jpg" class="d-block w-100" alt="iran-pic">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
