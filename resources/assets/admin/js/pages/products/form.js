import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import bsCustomFileInput from 'bs-custom-file-input';

const FORM_DATA = 'form#productForm';

export default class FormData {
    constructor() {
        this.initEditor();
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

    // init edit for input
    initEditor() {
        ClassicEditor.create(document.querySelector('textarea[name=description]'))
        .catch( error => {
            console.error( error );
        } );
    }
}
