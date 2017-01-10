// Some random js stuff.


function setLanguage(language) 
{
    $.get("/helpers/translator.php?language="+language);
    location.reload();
}

function addToCart(id) {
    $.get("/cart/add?prodId="+id+"&quantity=1");
}

function increaseCartItem(id) {
    $.get("/cart/increase?prodId="+id);
    // TODO: Increase the display!
}

function removeCartItem(id) {
    $.get("/cart/remove?prodId="+ id);
    // TODO: Increase the display!
}

function decreaseCartItem(id) {
    $.get("/cart/decrease?prodId="+id);
    // TODO: Increase the display!
}

function clearCart() {
    $.get("/cart/clear");
}

// A $( document ).ready() block.
$( document ).ready(function() {

    // Setup the language change buttons.
    $('#setLanDe').on("click", function() {setLanguage("de");});
    $('#setLanEn').on("click", function() {setLanguage("en");});

    $( "#searchField" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          method: "POST",
          url: "/catalog/search",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2}); 
});
