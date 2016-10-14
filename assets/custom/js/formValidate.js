$.fn.validateForm = function(formName) {
    var formElem = document.getElementsByName(formName)[0].elements;
    var hasError = false;

    $.each(formElem, function(index, element) {
        var elemHasError = false;

        var elemId = element.id;

        if((element.className).split(/\s/).indexOf('number') > 0 && $.fn.numberValidate(element.value)) {
            $.fn.displayError(elemId, 'Only number is allowed.');
            hasError = elemHasError =  true;
        }

        if((element.className).split(/\s/).indexOf('email') > 0 && $.fn.emailValidate(element.value)) {
            $.fn.displayError(elemId, 'Invalid email.');
            hasError = elemHasError =  true;
        }

        if((element.className).split(/\s/).indexOf('required') > 0 && $.fn.requiredValidate(element.value)) {
            $.fn.displayError(elemId, 'This field is required.');
            hasError = elemHasError =  true;
        }

        if(!elemHasError && elemId != '') $.fn.hideError(elemId);

    });

    return !hasError;
};

$.fn.requiredValidate = function(value) {
    return (value.length === 0 || !value.trim())
}

$.fn.numberValidate = function(value) {
    return !(!isNaN(value)
                && parseInt(Number(value)) == value
                && !isNaN(parseInt(value, 10)));
}

$.fn.emailValidate = function(value) {
    return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value));
}

$.fn.displayError = function(elemId, msg) {
    if (elemId == '') return false;
    $("#"+elemId).parent().parent().addClass('has-error');
    $("#"+elemId).siblings('.form-msg').addClass('text-red').html(msg).show();
}

$.fn.hideError = function(elemId) {
    if (elemId == '') return false;
    $("#"+elemId).parent().parent().removeClass('has-error');
    $("#"+elemId).siblings('.form-msg').removeClass('text-red').html('').hide();
}

$.fn.hideAllError = function(formName) {
    if (formName == '') return false;
    var formElem = $("#"+formName)[0].elements;
    $.each(formElem, function(index, element) {
        $.fn.hideError(element.id);
    });
}