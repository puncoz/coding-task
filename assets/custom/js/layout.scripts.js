$(function() {

    // ToolTip
    $('[data-toggle="tooltip"]').tooltip()

    // Load Form in Popup
    $(document).off("click", ".loadForm").on("click", ".loadForm", function(event) {
        event.preventDefault();

        var obj         = $(this),
            btnLabel    = obj.data('popupbtnlabel'),
            popupTitle  = obj.data('popuptitle'),
            popupClass  = obj.data('popupclass');
        $.fn.loadAddForm(obj, btnLabel, popupTitle, popupClass);
    });

    $(".bootbox-confirm").bind("click", function(e) {
        e.preventDefault();
        var location = $(this).attr('href');
        var msg = $(this).data('msg')
        bootbox.confirm(msg, function(result) {
            if(result) {
                window.location.replace(location);
            }
        });
    });
});