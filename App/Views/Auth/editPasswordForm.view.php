<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form id="editPasswordForm" method="post" action="?c=auth&a=editPassword">
                <div class="mb-3 form_input">
                    <label for="old_password" class="form-label oNasText">Staré heslo</label>
                    <input id="old_password" type="password" class="form-control" name="old_password" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badOldPass'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badOldPass'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="new_password" class="form-label oNasText">Nové heslo</label>
                    <input id="new_password" type="password" class="form-control" name="new_password" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badNewPass'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badNewPass'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 form_input">
                    <label for="new_password_again" class="form-label oNasText">Nové heslo znovu</label>
                    <input id="new_password_again" type="password" class="form-control" name="new_password_again" required>
                    <i class="visually-hidden oNasText fas fa-check-circle"></i>
                    <i class="visually-hidden oNasText fas fa-exclamation-circle"></i>
                    <p class="visually-hidden oNasText">Error message</p>
                    <?php if ($data['badNewPassAgain'] != "") { ?>
                        <div class="alert alert-danger alert-dismissible mt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['badNewPassAgain'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3 w-100">
                    <button type="submit" class="btn btn-warning ">Zmeniť heslo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/form_validation.js"></script>