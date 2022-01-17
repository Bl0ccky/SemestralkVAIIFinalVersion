<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form id="reg_form" method="post" action="?c=auth&a=registration">
                <div class="mb-3 form_input">
                    <label for="name" class="form-label oNasText">Meno</label>
                    <input id="name" type="text" class="form-control" name="name" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badName'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badName'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="lastName" class="form-label oNasText">Priezvisko</label>
                    <input id="lastName" type="text" class="form-control" name="last_name" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badLastName'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badLastName'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="date" class="form-label oNasText">Dátum narodenia</label>
                    <input id="date" type="date" class="form-control" name="date" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badDate'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badDate'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="email" class="form-label oNasText">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badEmail'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badEmail'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="login" class="form-label oNasText">Login</label>
                    <input id="login" type="text" class="form-control" name="login" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badLogin'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badLogin'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="password" class="form-label oNasText">Heslo</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    <i class="visually-hidden fas fa-check-circle"></i>
                    <i class="visually-hidden fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badPassword'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badPassword'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning">Registrovať</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/form_validation.js"></script>


