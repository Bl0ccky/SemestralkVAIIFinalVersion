<?php /** @var Array $data */
$id_blog = $data['id_blog'];
$blog = \App\Models\Blog::getOne($id_blog);
$user = \App\Models\User::getOne($blog->getIdUser())?>
<div class="container text-center">
        <div class="row">
            <div class="col-12">
                <img class="img-fluid w-100" src="<?= \App\Config\Configuration::BLOG_IMAGE_DIR . $blog->getImage() ?>" alt="blog_img">
            </div>
        </div>
    <div class="col-12">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 align-self-end text-end pe-5">
                <?php if($user->getImage()) { ?>
                    <img style="height: 25%; width: 25%; margin-top: -10%;" src="<?= \App\Config\Configuration::PROFILE_IMAGE_DIR . $user->getImage() ?>" alt="UserProfilePic">
                <?php } else { ?>
                    <img style="height: 25%; width: 25%; margin-top: -10%;" src="<?= \App\Config\Configuration::DEFAULT_PROFILE_IMAGE ?>" alt="UserProfilePic">
                <?php } ?>

                <div class="oNasText">Autor: <?= $user->getFullName() ?></div>
            </div>
        </div>
        <div class="row">
            <div class="tourGuyNadpis col-12 align-self-center text-center mb-3"><?= $blog->getName() ?></div>
        </div>
        <div class="row">
            <div class="oNasText col-12"><?= $blog->getText() ?></div>
        </div>


    </div>

</div>
