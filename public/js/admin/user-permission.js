var openfreedms = openfreedms || {};

openfreedms.userPermission = (function () {
    var pub = {
        init: function () {
            // bind events
            $('#js-user-dropdown').on('change', function () {
                var val = $(this).val();
                var docDropdown = $('#js-document-dropdown');
                if (val) {
                    var url = '/admin/ajax/no-user-perm-docs?userId=' + val;
                    $.get(url, function (data) {
                        docDropdown.html(data);
                    })
                } else {
                    docDropdown.find('option').each(function () {
                        if ($(this).val()) {
                            $(this).remove();
                        }
                    });
                }
            });
        }
    };
    return pub;
})();

$(function () {
    openfreedms.userPermission.init();
});
