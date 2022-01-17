<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form id="addTourForm" method="post" action="?c=admin&a=addTour" enctype="multipart/form-data">
                <div class="mb-3 form_input">
                    <label for="name" class="form-label oNasText">Názov zájazdu</label>
                    <input id="name" type="text" class="form-control" name="tour_name" maxlength="255" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden errorText">Error message</p>
                    <?php if ($data['badName'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badName'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="tour_image" class="form-label oNasText">Obrázok</label>
                    <input id="tour_image" type="file" class="form-control" name="tour_image" required>
                </div>
                <?php if ($data['badImage'] != "") { ?>
                    <div class="alert alert-danger alert-dismissible mt-1">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <?= $data['badImage'] ?>
                    </div>
                <?php } ?>
                <div class="mb-3 form_input">
                    <label for="price" class="form-label oNasText">Cena</label>
                    <input id="price" type="number" class="form-control" name="tour_price" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden errorText">Error message</p>
                    <?php if ($data['badPrice'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badPrice'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="date" class="form-label oNasText">Termín</label>
                    <input id="date" type="date" class="form-control" name="tour_date" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden errorText">Error message</p>
                    <?php if ($data['badDate'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badDate'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="capacity" class="form-label oNasText">Kapacita</label>
                    <input id="capacity" type="number" class="form-control" name="tour_capacity" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden errorText">Error message</p>
                    <?php if ($data['badCapacity'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badCapacity'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="tour_info" class="form-label oNasText">Popis</label>
                    <textarea id="tour_info" class="form-control" name="tour_info" required></textarea>
                </div>
                <div class="mb-3 w-100">
                    <button type="submit" class="btn btn-warning">Pridať</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/form_validation.js"></script>
