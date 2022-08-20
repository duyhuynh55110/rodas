import bsCustomFileInput from 'bs-custom-file-input';

const FORM_DATA = 'form#product-form';

export default class FormData {
    constructor() {
        this.initFormValidate();
    }

    // init form validate
    initFormValidate() {
        // init jQuery Validation
        $(FORM_DATA).validate({
            messages: {
                image_file_upload: {
                    accept: 'This field must be image type JPG/JPEG/PNG.',
                },
            },
        });

        // support preview better input file
        bsCustomFileInput.init();
    }
}
