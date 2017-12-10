$(document).ready(function () {

    var deck = $('#myDeck').attr('data-deck');
    var main = $('#myHand').attr('data-main');
    var defausse = $('#myDefausse').attr('data-defausse');
    var defausse2 = $('#otherDefausse').attr('data-defausse');
    var token = $('#myHand').attr('data-token');
    var user = $('#myContainer').attr('data-login');
    var partie = $('#myContainer').attr('data-partie');

    getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/deck/" + deck, function (resp) {
        var elem, elem2;
        $.each(resp['Cartes'], function (i, val) {
            elem = document.createElement("li");
            elem2 = document.createElement("div");
            elem2.className = "card back";
            elem2.id = val;
            elem.appendChild(elem2);
            $('#myDeck').append(elem);
        });
    });
    getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/main/" + main, function (resp) {
        var elem, elem2;
        $.each(resp['Cartes'], function (i, val) {
            elem = document.createElement("li");
            elem2 = document.createElement("a");
            elem2.className = "card rank-" + val;
            if (token) {
                elem2.addEventListener("click", function () {
                    jouerCarte(val);
                });
            } else
                elem2.href = "#";
            elem.appendChild(elem2);
            $('#myHand').append(elem);
        });
    });
    getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/defausse/" + defausse, function (resp) {
        var elem, elem2;
        $.each(resp['Cartes'], function (i, val) {
            console.log(resp);
            elem = document.createElement("li");
            elem2 = document.createElement("div");
            elem2.className = "card rank-" + val;
            elem.appendChild(elem2);
            $('#myDefausse').append(elem);
        });
    });
    if (defausse2 !== "null") {
        getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/defausse/" + defausse2, function (resp) {
            var elem, elem2;
            $.each(resp['Cartes'], function (i, val) {
                console.log(resp);
                elem = document.createElement("li");
                elem2 = document.createElement("div");
                elem2.className = "card rank-" + val;
                elem.appendChild(elem2);
                $('#otherDefausse').append(elem);
            });
        });
    }

    function getAjax(type, url, d) {
        $.ajax({
            type: type,
            url: url
        }).done(d)
                .error(function () {
                    console.log("No connection");
                });
    }

    function jouerCarte(val) {
        getAjax("POST", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/deleteMain/" + main + "/" + val + "/" + user + "/" + partie, function (resp) {
            var elem, elem2;
            $.each(resp['Cartes'], function (i, val) {
                elem = document.createElement("li");
                elem2 = document.createElement("a");
                elem2.className = "card rank-" + val;
                elem2.href = "#";
                elem.appendChild(elem2);
                $('#myHand').append(elem);
            });
        });
    }

});