<?php /** @var Array $data */
$id_tour = $data['id_tour'];
$tour = \App\Models\Tour::getOne($id_tour); ?>

<div class="container">
    <?php if ($data['successEdit'] != "") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= $data['successEdit'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row">
        <div class="tourGuyNadpis mb-4 col-3"><?= $tour->getName() ?>
            <?php if (\App\Auth::isLogged() && \App\Auth::isAdmin($_SESSION['email'])) { ?>
            <form class="col-3" method="post" action="?c=admin&a=specificTourEditForm">
                <button type="submit" class="btn p-0" style="color: white; font-size: 20px;">
                    <i class="fas fa-edit"></i>
                </button>
                <input name="edited_tour" type="hidden" value="<?= $tour->getId(); ?>">
            </form>
            <?php } ?>
        </div>
        <div class="col-1">
            <img class="img_country" src="<?= \App\Config\Configuration::TOUR_IMAGE_DIR . $tour->getImage() ?>" alt="country_img">
        </div>
    </div>


    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Cena</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $tour->getPrice() ?>€
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Termín</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $tour->getDateEU() ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Popis</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $tour->getInfo() ?>
                            </div>
                        </div>
                        <div class="row bottom_of_tour">
                            <form class="col-6" method="post" action="?c=home&a=joinTour">
                                <button type="submit"
                                        class="but_objednat_zaj p-1 p-sm-2 p-md-3"
                                        style="<?= ($tour->isFull() || \App\Auth::alreadyBookedTour($tour->getId())) ? "color: #272727; background-color: #fed00d;" : "" ?>"
                                    <?= ($tour->isFull() || \App\Auth::alreadyBookedTour($tour->getId())) ? "disabled" : "" ?>>
                                    <?php if ($tour->isFull())
                                    {
                                        echo "Kapacita naplnená";
                                    } else if(\App\Auth::alreadyBookedTour($tour->getId())){
                                        echo "Objednané";
                                    }
                                    else
                                    {
                                        echo "Objednať zájazd";
                                    }?></button>
                                <input name="id_tour" type="hidden" value="<?= $tour->getId() ?>">
                            </form>

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

<?php if(\App\Auth::isLogged() && \App\Auth::alreadyBookedTour($tour->getId())) { ?>
<div class="container">
    <div class="row">
        <div class="main-body col-12">
            <div class="tourGuyNadpis mb-4">Napísať recenziu</div>
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <form method="post" action="?c=home&a=addReview">
                            <div class="card-body">
                                <textarea name="review" placeholder="Napíšte, čo si o tomto zájazde myslíte"
                                          class="col-12" required></textarea>
                                <button type="submit" class="but_objednat_zaj p-1 p-sm-2 p-md-3">Uverejniť recenziu</button>
                                <input name="id_tour" type="hidden" value="<?= $tour->getId(); ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php } ?>


<div class="container">
    <div class="row">
        <div class="main-body col-6">
            <div class="tourGuyNadpis mb-4">Prihlásení užívatelia</div>
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row" style="font-weight: bold">
                                <div class="col-sm-3">
                                    Login
                                </div>
                                <div class="col-sm-9">
                                    Celé meno
                                </div>
                            </div>
                            <hr class="mb-4">
                            <?php foreach (\App\Models\User::getAll() as $user) {
                                foreach (\App\Models\JoinedTour::getAll() as $joined_tour) {
                                    if ($joined_tour->getIdUser() == $user->getId() && $joined_tour->getIdTour() == $tour->getId()) { ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><?= $user->getLogin() ?></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?= $user->getFullName() ?>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php }
                                }
                            } ?>
                            <span class="text-end col-12" style="<?= $tour->isFull() ? "font-weight: bold" : "" ?>">
                                Kapacita <?= \App\Auth::getNumOfOrdersForTour($tour->getId()) ?> / <?= $tour->getCapacity() ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-body col-6">
            <div class="tourGuyNadpis mb-4">Recenzie</div>
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row" style="font-weight: bold">
                                <div class="col-sm-3">
                                    Meno užívateľa
                                </div>
                                <div class="col-sm-9">
                                    Text recenzie
                                </div>
                            </div>
                            <hr class="mb-4">
                            <?php foreach (\App\Models\User::getAll() as $user) {
                                foreach (\App\Models\Review::getAll() as $review) {
                                    if ($review->getIdUser() == $user->getId() && $review->getIdTour() == $tour->getId()) { ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><?= $user->getFullName() ?></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?= $review->getText() ?>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php }
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



