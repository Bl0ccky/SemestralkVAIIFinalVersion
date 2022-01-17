function removeTour(id_tour) {
    fetch('?c=admin&a=deleteTour&deleted_tour=' + id_tour);
    document.getElementById(id_tour).remove();
}