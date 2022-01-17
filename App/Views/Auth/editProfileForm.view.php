<?php /** @var Array $data */
use App\Config\Configuration; ?>
<div class="container">
    <?php if ($data['correctMessage'] != "") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= $data['correctMessage'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>
<div class="container">
    <form id="editProfileForm" method="post" action="?c=auth&a=editProfile" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
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
                            <label for="profile_image" class="form-label">Zmeniť profilovú fotku</label>
                            <input id="profile_image" name="profile_image" class="form-control" type="file">
                            <div class="mt-3">
                                <h4><?= \App\Models\User::getOne(\App\Auth::getId())->getFullName() ?></h4>
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
                                <h6><label for="name" class="mb-0">Meno</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?= \App\Models\User::getOne(\App\Auth::getId())->getName() ?>" required>
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
                                <h6><label for="lastName" class="mb-0">Priezvisko</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="lastName" name="last_name" type="text" class="form-control"
                                       value="<?= \App\Models\User::getOne(\App\Auth::getId())->getLastName() ?>"
                                       required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badLastName'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badLastName'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="login" class="mb-0">Login</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="login" name="login" type="text" class="form-control"
                                       value="<?= \App\Models\User::getOne(\App\Auth::getId())->getLogin() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badLogin'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badLogin'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="email" class="mb-0">Email</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="email" name="email" type="email" class="form-control"
                                       value="<?= \App\Models\User::getOne(\App\Auth::getId())->getEmail() ?>" required>
                                <i class="visually-hidden oNasText fas fa-check-circle"></i>
                                <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                                <p class="visually-hidden oNasText">Error message</p>
                                <?php if ($data['badEmail'] != "") { ?>
                                    <div class="alert alert-danger alert-dismissible mt-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <?= $data['badEmail'] ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6><label for="date" class="mb-0">Dátum narodenia</label></h6>
                            </div>
                            <div class="col-sm-9 text-secondary form_input">
                                <input id="date" name="date" type="date" class="form-control"
                                       value="<?= \App\Models\User::getOne(\App\Auth::getId())->getDate() ?>" required>
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
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3 text-secondary">
                                <button type="submit" class="btn btn-warning px-4">Uložiť zmeny</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="?c=auth&a=editPasswordForm" class="btn btn-warning px-4">Zmena hesla</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="public/form_validation.js"></script>

