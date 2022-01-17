<?php /** @var Array $data */
$id_tour = $data['id_tour'];
$tour = \App\Models\Tour::getOne($id_tour);
use App\Config\Configuration; ?>
<div class="container">
    <form id="editTourForm" method="post" action="?c=admin&a=editTour" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= Configuration::TOUR_IMAGE_DIR . $tour->getImage() ?>"
                                 alt="Admin"
                                 class="rounded-circle" width="150" height="150">
                            <label for="tour_image" class="form-label">Zmeniť obrázok zájazdu</label>
                            <input id="tour_image" name="tour_image" class="form-control" type="file">
                            <div class="mt-3">
                                <h4><?= $tour->getName() ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 align-items-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="name" class="mb-0">Názov</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="name" name="tour_name" type="text" class="form-control"
                                       value="<?= $tour->getName() ?>" required>
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
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="price" class="mb-0">Cena</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="price" name="tour_price" type="number" class="form-control"
                                       value="<?= $tour->getPrice() ?>"
                                       required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badPrice'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badPrice'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="date" class="mb-0">Termín</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="date" name="tour_date" type="date" class="form-control"
                                       value="<?= $tour->getDate() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badDate'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badDate'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="capacity" class="mb-0">Kapacita</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="capacity" name="tour_capacity" type="number" class="form-control"
                                       value="<?= $tour->getCapacity() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badCapacity'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badCapacity'] ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="tour_info" class="mb-0">Popis</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <textarea id="tour_info" class="form-control" name="tour_info" form="editTourForm" required><?= $tour->getInfo() ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3 text-secondary">
                                <button type="submit" class="btn btn-warning px-4">Uložiť zmeny</button>
                            </div>
                            <input name="edited_tour" type="hidden" value="<?= $tour->getId(); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="public/form_validation.js"></script>

