<?php /** @var Array $data */ ?>

<div class="container">
    <div class="tourGuyNadpis">Zaregistrovaní užívatelia</div>
    <div class="row text-center mb-5">
        <?php if ($data['message'] != "") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $data['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form method="post" action="?c=admin&a=editUsers">
            <table class="table oNasText">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">Admin</th>
                </tr>
                </thead>

                <?php foreach ($data['users'] as $user) { ?>
                    <tbody>
                    <tr>
                        <th scope="row"><?= $user->getId(); ?></th>
                        <td><?= $user->getName() ?></td>
                        <td><?= $user->getLastName() ?></td>
                        <td>
                            <input name="<?= $user->getId() ?>" type="checkbox" class="form-check-input mt-2"
                                   value="checked" <?php if ($user->getAuthorization() == "admin") echo " checked "; ?>  <?php if ($user->getId() == \App\Auth::getId()) echo "disabled" ?> >
                            <?php if ($user->getAuthorization() == "admin" && $user->getId() == \App\Auth::getId()) { ?>
                                <input id="checkedInput" type="hidden" value="checked" name="<?= $user->getId() ?>">
                            <?php } ?>

                        </td>
                    </tr>
                    </tbody>
                <?php } ?>
            </table>
            <input name="id_tour" type="hidden" value="<?= $user->getId(); ?>">
            <div class="mb-3">
                <button type="submit" class="btn btn-warning">Potvrdiť</button>
            </div>
        </form>
    </div>

    <div class="tourGuyNadpis">Zájazdy</div>
    <div class="row text-center mb-5">
        <?php if ($data['deletedTour'] != "") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $data['deletedTour'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
            <table class="table oNasText">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Obrázok</th>
                    <th scope="col">Názov</th>
                    <th scope="col">Dátum</th>
                    <th scope="col">Naplnenosť</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($data['tours'] as $tour) { ?>
                    <tr id="<?= $tour->getId() ?>" class="align-middle">
                        <th scope="row"><?= $tour->getId() ?></th>
                        <td ><img src="<?= \App\Config\Configuration::TOUR_IMAGE_DIR . $tour->getImage() ?>"
                                  class="img-fluid img_country" alt="country-flag"></td>
                        <td><?= $tour->getName() ?></td>
                        <td><?= $tour->getDateEU() ?></td>
                        <td><?= \App\Auth::getNumOfOrdersForTour($tour->getId()) ?> / <?= $tour->getCapacity() ?></td>
                        <td>
                            <form method = "post" action = "?c=admin&a=specificTourEditForm">
                                <button type = "submit" class = "btn p-0" style = "color: white; font-size: 20px;">
                                    <i class = "fas fa-edit"></i>
                                    </button>
                                <input name="edited_tour" type="hidden" value="<?= $tour->getId() ?>">
                            </form>
                        </td>
                        <td>
                            <button class="btn p-0" style="color: white; font-size: 20px;"
                                        onclick="removeTour(<?= $tour->getId() ?>)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
    </div>
</div>

<script src="public/ajaxDeleteTour.js"></script>