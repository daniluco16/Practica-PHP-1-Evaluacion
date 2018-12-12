$("document").ready(function () {

    $('#ensenanzas').bind('change', function ()
    {
        alert("hola");
        var $form = $(this).closest('form');

        $form.find('input[type=submit][name="submit"]').click();

    });

});


