import {
    PAGE_LENGTH,
    PAGE_LENGTH_MENU,
    DATATABLE_SDOM,
    DATATABLE_ERROR_MODE,
} from './constants';

try {
    /****************************************/
    /*     Import libraries                 */
    /****************************************/
    window.$ = window.jQuery = require('jquery');
    window.moment = require('moment');
    window.toastr = require('toastr');
    window.swal = require('sweetalert2');

    require('bootstrap');
    require('datatables.net');
    require('datatables.net-bs4');
    require('datatables.net-responsive');
    require('datatables.net-select');
    require('datatables.net-rowreorder');
    require('datatables.net-rowreorder-bs4');
    require('select2');
    require('daterangepicker');
    require('jquery-validation');

    // change message
    $.validator.messages = {
        required: 'This field is required.',
        remote: 'This field is not valid.',
        email: 'Please enter a valid email address.',
        url: 'Please enter a valid URL.',
        date: 'Please enter a valid date.',
        dateISO: 'Please enter a valid date (ISO).',
        number: 'Please enter a valid number.',
        digits: 'Please enter only digits.',
        equalTo: 'Please enter the same value again.',
        maxlength: $.validator.format(
            'Please enter no more than {0} characters.'
        ),
        minlength: $.validator.format('Please enter at least {0} characters.'),
        rangelength: $.validator.format(
            'Please enter a value between {0} and {1} characters long.'
        ),
        range: $.validator.format('Please enter a value between {0} and {1}.'),
        max: $.validator.format(
            'Please enter a value less than or equal to {0}.'
        ),
        min: $.validator.format(
            'Please enter a value greater than or equal to {0}.'
        ),
        step: $.validator.format('Please enter a multiple of {0}.'),
    };

    require('jquery-validation/dist/additional-methods.js');
    require('admin-lte');

    /****************************************/
    /*     End Import libraries             */
    /****************************************/

    /****************************************/
    /*     Init global                      */
    /****************************************/
    // settings default for datatable
    $.extend($.fn.dataTable.defaults, {
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        lengthChange: true,
        dom: DATATABLE_SDOM,
        pageLength: PAGE_LENGTH,
        lengthMenu: PAGE_LENGTH_MENU,
        order: [[0, 'desc']],
        fnDrawCallback: function (settings) {
            // Make pagination
            let paginate = $('#' + settings.nTable.id + '_paginate');

            if (settings.fnRecordsDisplay() == 0) {
                paginate.hide();
            } else {
                paginate.show();
            }
        },
    });
    $.fn.dataTable.ext.errMode = DATATABLE_ERROR_MODE;

    // settings default jQuery validation
    $.validator.setDefaults({
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group > .col-sm-10').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            $(':submit').prop('disabled', true);
            form.submit();
        },
    });

    // validate filesize
    $.validator.addMethod(
        'filesize',
        function (value, element, param) {
            if (element.files.length < 1) {
                return true;
            }

            var size = element.files[0].size;
            return this.optional(element) || size <= param;
        },
        'File size must not exceed {0} bytes'
    );

    /****************************************/
    /*     End Init global                  */
    /****************************************/
} catch (e) {}
