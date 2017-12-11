$(document).ready(function () {

    var Iddeck = $('#myDeck').attr('data-deck');
    var Idmain = $('#myHand').attr('data-main');
    var Iddefausse = $('#myDefausse').attr('data-defausse');
    var Iddefausse2 = $('#otherDefausse').attr('data-defausse');
    var token = $('#myHand').attr('data-token');
    var user = $('#myContainer').attr('data-login');
    var partie = $('#myContainer').attr('data-partie');

    deck(Iddeck);
    main(Idmain);
    defausse(Iddefausse);
    defausseAd(Iddefausse2);

    function deck(Iddeck) {
        getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/deck/" + Iddeck, function (resp) {
            var elem, elem2;
            $('#myDeck').empty();
            $.each(resp['Cartes'], function (i, val) {
                elem = document.createElement("li");
                elem2 = document.createElement("div");
                elem2.className = "card back";
                elem2.id = val;
                elem.appendChild(elem2);
                $('#myDeck').append(elem);
            });
        });
    }

    function main(Idmain) {
        getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/main/" + Idmain, function (resp) {
            var elem, elem2;
            $('#myHand').empty();
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
    }

    function defausse(Iddef) {
        getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/defausse/" + Iddef, function (resp) {
            var elem, elem2;
            $('#myDefausse').empty();
            $.each(resp['Cartes'], function (i, val) {
                console.log(resp);
                elem = document.createElement("li");
                elem2 = document.createElement("div");
                elem2.className = "card rank-" + val;
                elem.appendChild(elem2);
                $('#myDefausse').append(elem);
            });
        });
    }

    function defausseAd(Iddef) {
        if (Iddef !== "null") {
            getAjax("GET", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/defausse/" + Iddef, function (resp) {
                var elem, elem2;
                $('#otherDefausse').empty();
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
        getAjax("POST", "http://localhost/L3/Web_Projet/Symfony/web/app_dev.php/deleteMain/" + Idmain + "/" + val + "/" + user + "/" + partie + "/" + Iddefausse, function (resp) {
            var elem, elem2;
            $('#myHand').empty();
            $.each(resp['Cartes'], function (i, val) {
                elem = document.createElement("li");
                elem2 = document.createElement("a");
                elem2.className = "card rank-" + val;
                elem2.href = "#";
                elem.appendChild(elem2);
                $('#myHand').append(elem);
            });
            defausse(Iddefausse);
        });
    }

});