// Some random js stuff.


function setLanguage(language) 
{
    $.get("/helpers/translator.php?language="+language);
    location.reload();
}

// A $( document ).ready() block.
$( document ).ready(function() {
    $('#setLanDe').on("click", function() {setLanguage("de");});
    $('#setLanEn').on("click", function() {setLanguage("en");});
});
