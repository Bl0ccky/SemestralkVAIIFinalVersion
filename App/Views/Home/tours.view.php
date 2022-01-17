<?php /** @var Array $data */ ?>
<div class="container">
    <div class="tourGuyNadpis">Naše Zájazdy</div>
    <div class="row text-center mb-5">
        <?php if ($data['message'] != "") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $data['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div class="oNasText">
            <div class="row mb-3 ">
                <div class="col-sm-2 align-self-start mt-1">
                    <h6><label for="min_price" class="mb-0">Min cena zájazdu</label></h6>
                </div>
                <div class="col-sm-2 text-secondary form_input">
                    <input id="min_price" type="number" class="form-control">
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-2 align-self-start mt-1">
                    <h6><label for="max_price" class="mb-0">Max cena zájazdu</label></h6>
                </div>
                <div class="col-sm-2 text-secondary form_input">
                    <input id="max_price" type="number" class="form-control">
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4 text-secondary form_input">
                    <button id="btn_filter" class="btn btn-warning w-75 h-100">Filtrovať</button>
                </div>
            </div>
        </div>

        <div id="toursAfterFilter" class="row text-center mb-5"> </div>

        <div id="toursBeforeFilter" class="row text-center mb-5">
            <?php foreach ($data['tours'] as $tour) { ?>
                <div class="profil tour col-12 col-md-6 col-lg-3">
                    <div class="row flex-column justify-content-center h-100">
                        <div>
                            <div class="nadpis_profil"><?= $tour->getName() ?></div>
                            <img src="<?= \App\Config\Configuration::TOUR_IMAGE_DIR . $tour->getImage() ?>"
                                 class="img-fluid img_country" alt="country-flag"><br>
                            Cena: <?= $tour->getPrice() ?>€<br>
                            Termín: <?= $tour->getDateEU() ?><br>
                            Popis: <?= $tour->getInfo() ?><br>
                        </div>
                        <div>
                            <div class="mt-3 bottom_of_tour">
                                <form method="post" action="?c=home&a=specificTourForm">
                                    <button type="submit" class="but_objednat_zaj p-1 p-sm-2 p-md-3">Zistiť viac</button>
                                    <input name="id_tour" type="hidden" value="<?= $tour->getId(); ?>">
                                </form>
                                <div class="text-end" style="<?= $tour->isFull() ? "font-weight: bold" : "" ?>">
                                    Kapacita <?= \App\Auth::getNumOfOrdersForTour($tour->getId()) ?> / <?= $tour->getCapacity() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
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

<script src="public/form_validation.js"></script>
<script src="public/ajaxFindTourByPrice.js"></script>