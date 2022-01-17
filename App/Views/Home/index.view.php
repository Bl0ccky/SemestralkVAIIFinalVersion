<?php /** @var Array $data */ ?>
<div class="container text-center">
    <?php if ($data['message'] != "") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= $data['message'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="nadpis">BookWell</div>
    <div class="nadpis2">Vybavíme to za Vás</div>
    <div class="text_hl_stranka">Radi cestujete a nemáte čas na vybavovanie ubytovania, leteniek, víz a podobne?<br> Žiadny
        problém, my to vybavíme za Vás! Stačí si buď vybrať z našich predvolených zájazdov alebo si naklikať parametre podľa seba a
        my Vám vyrobíme zájazd na mieru.
    </div>

    <div class="row">
        <img class="img-fluid obrazok_hl_stranka" src="public/images/travelling.jpg" alt="cestovanie">
    </div>
    <div class="container-fluid">
        <a href="?c=home&a=tours" role="button" class="btn but_objednat p-1 p-sm-2 p-md-4">Objednať zájazd</a>
    </div>

</div>
