var openfreedms = openfreedms || {};

openfreedms.departmentPermission = (function () {
    var pub = {
        init: function () {
            // bind events
            $('#js-department-dropdown').on('change', function () {
                var val = $(this).val();
                var docDropdown = $('#js-document-dropdown');
                if (val) {
                    var url = '/admin/ajax/no-dept-perm-docs?deptId=' + val;
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
    openfreedms.departmentPermission.init();
});
