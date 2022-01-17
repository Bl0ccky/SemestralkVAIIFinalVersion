<?php /** @var Array $data */ ?>
<div class="container">
    <?php if ($data['correctMessage'] != "") { ?>
        <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= $data['correctMessage'] ?></strong>
            <?php if ($data['correctMessage2'] != "") { ?>
                    <div>
                <strong><?= $data['correctMessage2'] ?></strong>
                    </div>
            <?php } ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <?php if ($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } ?>
            <form method="post" action="?c=auth&a=login">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label oNasText">Email</label>
                    <input type="email" class="form-control" name="login" id="exampleFormControlInput1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label oNasText">Heslo</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlInput2" required>
                </div>
                <div class="row mb-3">
                    <div class="col-6 text-center">
                        <button type="submit" class="btn btn-warning">Prihlásiť</button>
                    </div>
                    <div class="col-6 text-center">
                        <a href="?c=auth&a=registrationForm" class="btn btn-warning">Nemám konto</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
