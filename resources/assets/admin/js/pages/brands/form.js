import bsCustomFileInput from 'bs-custom-file-input';

const FORM_DATA = 'form#brand-form';

export default class FormData {
    constructor() {
        this.initFormValidate();
    }

    // init form validate
    initFormValidate() {
        // init jQuery Validation
        $(FORM_DATA).validate({
            messages: {
                logo_file_upload: {
                    accept: 'Logo must be image.',
                },
            },
        });

        // support preview better input file
        bsCustomFileInput.init();
    }
}
