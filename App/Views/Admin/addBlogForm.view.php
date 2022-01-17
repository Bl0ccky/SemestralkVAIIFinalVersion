<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form id="addBlogForm" method="post" action="?c=admin&a=addBlog" enctype="multipart/form-data">
                <div class="mb-3 form_input">
                    <label for="name" class="form-label oNasText">Názov blogu</label>
                    <input id="name" type="text" class="form-control" name="blog_name" maxlength="255" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badName'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badName'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="blog_image" class="form-label oNasText">Obrázok</label>
                    <input id="blog_image" type="file" class="form-control" name="blog_image" required>
                </div>
                <?php if ($data['badImage'] != "") { ?>
                    <div class="alert alert-danger alert-dismissible mt-1">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <?= $data['badImage'] ?>
                    </div>
                <?php } ?>
                <div class="mb-3 form_input">
                    <label for="blog_text" class="form-label oNasText">Text blogu</label>
                    <textarea id="blog_text" class="form-control" name="blog_text" form="addBlogForm" required></textarea>
                </div>
                <div class="mb-3 w-100">
                    <button type="submit" class="btn btn-warning">Pridať</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/form_validation.js"></script>
