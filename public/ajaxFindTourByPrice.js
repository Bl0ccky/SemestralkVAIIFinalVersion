var btnFiler = document.getElementById('btn_filter');

class FilteredTours {
    getAllTours() {
        let minPriceValue = document.getElementById("min_price").value;
        let maxPriceValue = document.getElementById("max_price").value;

        fetch('?c=home&a=getAllTours&minPrice=' + minPriceValue + '&maxPrice=' + maxPriceValue)
            .then(response => response.json())
            .then(tourData => {
                let html = "";
                if (tourData !== 'ArrayIsEmpty') {

                    document.getElementById("toursBeforeFilter").style.display = "none";
                    for (let tour of tourData) {
                        fetch('?c=home&a=getNumOfOrders&id_tour=' + tour.id)
                            .then(response => response.json())
                            .then(numOfOrders => {

                                html += "<div class='profil tour col-12 col-md-6 col-lg-3'>"
                                    + "<div class='row flex-column justify-content-center h-100'>"
                                    + "<div>"
                                    + "<div class='nadpis_profil'>" + tour.name + "</div>"
                                    + "<img src=\"public/tours_images/" + tour.image + "\" class='img-fluid img_country' alt='country-flag'><br>"
                                    + "Cena: " + tour.price + "€<br>"
                                    + "Termín: " + tour.date + "<br>"
                                    + "Popis: " + tour.info + "<br>"
                                    + "</div>"
                                    + "<div>"
                                    + "<div class='mt-3 bottom_of_tour'>"
                                    + "<form method='post' action='?c=home&a=specificTourForm'>"
                                    + "<button type='submit' class='but_objednat_zaj p-1 p-sm-2 p-md-3'>Zistiť viac</button>"
                                    + "<input name='id_tour' type='hidden' value='" + tour.id + "'>"
                                    + "</form>"
                                    + "<div class='text-end'>"
                                    + "Kapacita " + numOfOrders + "/" + tour.capacity
                                    + "</div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>"

                                document.getElementById("toursAfterFilter").innerHTML = html;
                            })
                    }

                } else {
                    document.getElementById("toursAfterFilter").innerHTML = html+"<div class='oNasText'>"+"Zadanému rozsahu nevyhovuje žiadny zájazd!"+"</div>";
                }

            });




    }

}

window.onload = function () {
    var ajaxFilteredTours = new FilteredTours()
    btnFiler.addEventListener('click', () => {
        ajaxFilteredTours.getAllTours();
    })

}