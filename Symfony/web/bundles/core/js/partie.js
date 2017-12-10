$(document).ready(function () {

    var deck = $('#myDeck').attr('data-deck');
    var main = $('#myHand').attr('data-main');

    $.ajax({
        type: "GET",
        url: "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/deck/" + deck
    }).done(function (resp) {
        var elem, elem2;
        $.each(resp['Cartes'], function (i,val) {
            elem = document.createElement("li");
            elem2 = document.createElement("div");
            elem2.className = "card back";
            elem2.id = val;
            elem.appendChild(elem2);
            $('#myDeck').append(elem);
        });
    }).error(function () {
        console.log("No connection");
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/main/" + main
    }).done(function (resp) {
        var elem, elem2;
        $.each(resp['Cartes'], function (i,val) {
            console.log(resp);
            elem = document.createElement("li");
            elem2 = document.createElement("a");
            elem2.className = "card rank-" + val;
            elem2.href = "#";
            elem.appendChild(elem2);
            $('#myHand').append(elem);
        });

    }).error(function () {
        console.log("No connection");
    });



    $('.deck').click(function () {

    });

    $('.hand').click(function () {

    });


});