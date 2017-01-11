// Some random js stuff.


function setLanguage(language) 
{
    $.get("/helpers/translator.php?language="+language);
    location.reload();
}

function addToCart(id) {
    $.get("/cart/add?prodId="+id+"&quantity=1");
}

// These function are used in the cart!
function increaseCartItem(id) {
    $.get("/cart/increase?prodId="+id);
    updateCart();
}

function decreaseCartItem(id) {
    $.get("/cart/decrease?prodId="+id);
    updateCart();
}

function removeCartItem(id) {
    $.get("/cart/remove?prodId="+ id);
    updateCart();
}

function clearCart() {
    $.get("/cart/clear");
    $("table .cartitem").hide();
    updateCart();
}

function updateCart() {
    var totalPrice = 0;
    $.getJSON("/cart/json", function(data){
        $.each(data, function(key, val) {
            if (val.quantity == 0 ) {
                $("#"+val.id).hide();
            } else {
                // Set amount
                $("#"+val.id).find(".amount").html(val.quantity);

                // Set price
                $("#"+val.id).find(".price").html(val.price);
            }
            // Calculate total price
            totalPrice += val.price;
        });
        $("#cartPrice").html(totalPrice);
    }) 
}

function filterProducts() {
    var category = $("#categorySelect").val();
    $(".item-wrapper").hide();
    if (category == 0)
    {
        $(".item-wrapper").show();
    } else {
        $(".item-wrapper[category="+category+"]").show();
    }
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
      minLength: 2,
      select: function(event, ui) {
          event.preventDefault();
          $("#searchField").val(ui.item.label);         
          location.href = "/catalog/show/"+ui.item.value;
      }}); 
});

function setupValidation() {

    // This works. Use this for multilingual text.
    // TODO: Translate messages!
    $.extend(jQuery.validator.messages, {
        required: "This field is required!",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });

    $('#register').validate({ // initialize the plugin
        rules: {
            login: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6
            },
            firstName: {
                required: true,
            },
            lastName: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            street: {
                required: true,
            },
            houseNumber: {
                required: true,
                maxlength: 5,
            },
            city: {
                required: true,
            },
            zip: {
                required: true,
                minlength: 4,
                maxlength: 5
            }
        }
    });
}
