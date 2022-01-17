<?php /** @var Array $data */ ?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>BookWell</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="public/css.css">

</head>
<body>
<nav class="navbar fixed-top navbar-expand-xl">
    <div class="container-fluid">
        <a href="?c=home&a=index"> <img class="logo" src="public/images/logo.png" alt="Logo"></a>
        <div class="popis_logo">BookWell</div>
        <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $data['active'] == "home" ? "active" : "" ?>"
                       href="?c=home&a=index">Domov</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $data['active'] == "about" ? "active" : "" ?>" href="?c=home&a=about">O
                        nás</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?= $data['active'] == "tours" ? "active" : "" ?>"
                       href="?c=home&a=tours">Zájazdy</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?= $data['active'] == "blogs" ? "active" : "" ?>"
                       href="?c=home&a=blogs">Blog</a>
                </li>

                <?php if (\App\Auth::isLogged() && \App\Auth::isAdmin($_SESSION['email'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $data['active'] == "addTour" ? "active" : "" ?>"
                           href="?c=admin&a=addTourForm">Pridať zájazd</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $data['active'] == "addBlog" ? "active" : "" ?>"
                           href="?c=admin&a=addBlogForm">Pridať blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $data['active'] == "adminer" ? "active" : "" ?>"
                           href="?c=admin&a=adminer">Adminer</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (\App\Auth::isLogged()) { ?>
                    <li class="nav-item">
                        <a class="nav-link profile <?= $data['active'] == "profile" ? "active" : "" ?>"
                           href="?c=auth&a=profile"><?= \App\Models\User::getOne(\App\Auth::getId())->getLogin() ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=auth&a=logout">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $data['active'] == "login" ? "active" : "" ?>"
                           href="<?= \App\Config\Configuration::LOGIN_URL ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $data['active'] == "registration" ? "active" : "" ?>"
                           href="<?= \App\Config\Configuration::REGISTRATION_URL ?>">Registrácia</a>
                    </li>
                <?php } ?>
            </ul>


        </div>
    </div>
</nav>

<?= $contentHTML ?>
<footer class="pata text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <div class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/tomas.labat.31"
               role="button">
                <i class="fab fa-facebook-f"></i>
            </a>

            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/tomas.labat/"
               role="button"
            ><i class="fab fa-instagram"></i
                ></a>

            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Bl0ccky" role="button"
            ><i class="fab fa-github"></i
                ></a>
        </div>
        <!-- Section: Social media -->
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-white" href="?c=home&a=index">BookWell</a>
    </div>
    <!-- Copyright -->
</footer>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>

