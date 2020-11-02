
/** Cette fonction jquery s'exécutera uniquement lorsque le DOM sera chargé complètement */
$( document ).ready(function() {
    lazyload(); // initialisation du lazy load, notez bien dans le code html l'absence d'attribut "src" dans les images des cartes ! Comprenez ce qu'il se passe

    /** préparation de l'autocomplétion */
    $( "#search" ).keyup(function() {
        refreshDisplay( $("#search").val() );
    });
    $( "#search" ).on( "autocompleteselect", function( event, ui ) {
        refreshDisplay( ui.item.value);
    } );
    $(".autocomplete").autocomplete({
        source: datas,
        delay: 500
    });

});

// Creation de nouveaux sélecteurs pour jquery - pas besoin d'y toucher
$.expr[":"].containsNoCase = function(el, i, m) {
    var search = m[3];
    if (!search) return false;

    var pattern = new RegExp(search,"i");
    return pattern.test($(el).text());
};
$.expr[":"].notContainsNoCase = function(el, i, m) {
    var search = m[3];
    if (!search) return false;

    var pattern = new RegExp(search,"i");
    return ! pattern.test($(el).text());
};

/** fonction qui rafraichit l'affichage en masquant ou affichant les cartes en fonction de ce qui est tapé dans l'input */
function refreshDisplay(query)
{
    if (query != "")
    {
        $(".card h5:notContainsNoCase("+query+")").parent('.card').parent().hide();
        $(".card h5:containsNoCase("+query+")").parent('.card').parent().show();
    }
    else
    {
        $(".card").parent().show();
    }
}

