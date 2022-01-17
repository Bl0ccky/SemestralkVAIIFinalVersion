<?php /** @var Array $data */
use App\Config\Configuration; ?>
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php if(\App\Models\User::getOne(\App\Auth::getId())->getImage()) { ?>
                            <img src="<?= Configuration::PROFILE_IMAGE_DIR . \App\Models\User::getOne(\App\Auth::getId())->getImage() ?>"
                                 alt="UserProfilePic"
                                 class="rounded-circle" width="150" height="150">
                            <?php } else { ?>
                            <img src="<?= Configuration::DEFAULT_PROFILE_IMAGE ?>" alt="UserProfilePic" class="rounded-circle" width="150" height="150">
                            <?php } ?>
                            <div class="mt-3">
                                <h4><?= \App\Models\User::getOne(\App\Auth::getId())->getFullName() ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Meno</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= \App\Models\User::getOne(\App\Auth::getId())->getName() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Priezvisko</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= \App\Models\User::getOne(\App\Auth::getId())->getLastName() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Login</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= \App\Models\User::getOne(\App\Auth::getId())->getLogin() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= \App\Models\User::getOne(\App\Auth::getId())->getEmail() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dátum narodenia</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= \App\Models\User::getOne(\App\Auth::getId())->getDateEU() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <a class="btn btn-warning px-4 w-100" href="?c=auth&a=editProfileForm">Upraviť</a>
                            </div>
                            <div class="col-sm-3">
                                <form id="deleteAccForm" method="post" action="?c=auth&a=deleteAcc">
                                    <button type="submit" class="btn btn-danger px-4 w-100"
                                            onclick="return confirm('Naozaj chcete zrušit svoj účet?');">Zrušenie účtu
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <?php if ($data['message'] != "") { ?>
        <div class="col-4 offset-4 align-middle alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= $data['message'] ?>
        </div>
    <?php } ?>
</div>

<div class="container">
    <div class="tourGuyNadpis">Tvoje objednané zájazdy</div>
    <div class="row text-center mb-5">
        <?php foreach ($data['tours'] as $tour) {
            foreach ($data['joined_tours'] as $joined_tour) {
                if ($joined_tour->getIdUser() == $_SESSION['id_user'] && $joined_tour->getIdTour() == $tour->getId()) { ?>
                    <div class="profil tour col-12 col-md-6 col-lg-3">
                        <div class="row flex-column justify-content-between h-100">
                            <div>
                                <div class="nadpis_profil"><?= $tour->getName() ?></div>
                                <img src="<?= \App\Config\Configuration::TOUR_IMAGE_DIR . $tour->getImage() ?>"
                                     class="img-fluid img_country" alt="country-flag"><br>
                                Cena: <?= $tour->getPrice() ?>€<br>
                                Termín: <?= $tour->getDate() ?><br>
                                Popis: <?= $tour->getInfo() ?><br>
                                <div class="mt-3 bottom_of_tour">
                                    <form method="post" action="?c=home&a=leaveTour">
                                        <button type="submit"
                                                class="but_objednat_zaj p-1 p-sm-2 p-md-3">Odhlásiť zájazd
                                        </button>
                                        <input name="id_tour" type="hidden" value="<?= $tour->getId(); ?>">
                                    </form>
                                    <div class="text-end" style="<?= $tour->isFull() ? "font-weight: bold" : "" ?>">
                                        Kapacita <?= \App\Auth::getNumOfOrdersForTour($tour->getId()) ?>
                                        / <?= $tour->getCapacity() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        } ?>
    </div>
</div>


