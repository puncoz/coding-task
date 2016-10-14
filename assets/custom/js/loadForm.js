$.fn.loadAddForm = function(obj, btnLabel, title, additional_class) {
    // Default Argument
    if(additional_class === undefined) {
        additional_class = '';
    }

    // Buttons
    var buttons;
    if(btnLabel == '') {
        buttons = {
                close: {
                    label: "Close",
                    className: "btn-default",
                    callback: function() {
                        return true;
                    }
                }
            };
    } else {
        buttons = {
                submit: {
                    label: btnLabel,
                    className: "btn-success",
                    callback: function() {
                        $.fn.submitForm();
                        return false;
                    }
                },
                close: {
                    label: "Cancel",
                    className: "btn-danger",
                    callback: function() {
                        return true;
                    }
                }
            };
    }

    $.get(obj.attr('href'), function(resp) {
        bootbox
            .dialog({
                /**
                * @required String|Element
                */
                message: resp.message,

                /**
                * @optional String|Element
                * adds a header to the dialog and places this text in an h4
                */
                title: title,

                /**
                * @optional Function
                * allows the user to dismisss the dialog by hitting ESC, which
                * will invoke this function
                */
                onEscape: function() {
                    bootbox.hideAll();
                },

                /**
                * @optional Boolean
                * @default: true
                * whether the dialog should be shown immediately
                */
                show: true,

                /**
                * @optional Boolean
                * @default: true
                * whether the dialog should be have a backdrop or not
                */
                backdrop: true,

                /**
                * @optional Boolean
                * @default: true
                * show a close button
                */
                closeButton: false,

                /**
                * @optional Boolean
                * @default: true
                * animate the dialog in and out (not supported in < IE 10)
                */
                animate: true,

                /**
                * @optional String
                * @default: null
                * an additional class to apply to the dialog wrapper
                */
                className: "add_form_dialog "+additional_class,

                size: 'large',

                /**
                * @optional Object
                * @default: {}
                * any buttons shown in the dialog's footer
                */
                buttons: buttons
            });
    });
};

$.fn.submitForm = function() {
    var formName = "add_edit_form";
    var obj = $("#"+formName);

    if(!$.fn.validateForm(formName)) {
        return false;
    };

    // Populate all form Data
    var formData = new FormData(obj[0]);

    // get FormData of array
    // var arrInputName;// = $('.array').attr('name');
    // var arr = [];
    $.each($('.array'), function(key, input){
        var arrInputName = $(this).attr('name');
        var arr = [];
        if( (input.className).split(/\s/).indexOf('checkbox') > 0 ) {
            if(input.checked === true) arr.push(input.value);
        } else if( (input.className).split(/\s/).indexOf('select') > 0 ) {
            var var_arr = $(input).val();
            if(var_arr instanceof Array) {
                $.each( var_arr, function( index, value ) {
                    arr.push(value);
                });
            } else {
                arr.push(var_arr);
            }
        } else {
            arr.push(input.value);
        }
        formData.append(arrInputName,arr);
    });

    $(".fckeditor").each(function(index, value) {
        var oEditor = FCKeditorAPI.GetInstance($(this).attr('id'));
        formData.append($(this).attr('name'),oEditor.GetHTML());
    });

    $.ajax({
        url: obj.attr('action'),
        type: 'post',
        // data: obj.serialize(),
        // data: new FormData(obj[0]),
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function() {
            $(".bootbox.modal .btn-success").button('loading');
        },
        success: function(resp) {
            // hide all previous error message if any
            $.fn.hideAllError(formName);

            var respStatus = refreshPage = false;
            if(resp.status == 'error') {
                if (resp.message == 'form_error') {
                    $.each(resp.data, function(index, element) {
                        if(element.id == csrf_token_name) $("input[name="+element.id+"]").val(element.message);
                        else $.fn.displayError(element.id, element.message);
                    });
                } else {
                    respStatus = refreshPage = true;
                };
            } else if(resp.status == 'ok' || resp.status == 'warning') {
                respStatus = refreshPage = true;
            };
            $(".bootbox.modal .btn-success").button('reset');

            if(respStatus) bootbox.hideAll();

            if(refreshPage) window.location.replace(current_url);
        }
    })
};