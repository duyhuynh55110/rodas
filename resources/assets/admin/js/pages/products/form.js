import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import bsCustomFileInput from 'bs-custom-file-input';
import Dropzone from "dropzone";

const FORM_DATA = "form#productForm";
const IMAGE_SLIDES = ".image-slides";
const REVIEW_IMAGE_SLIDES = "#reviewImageSlides";
const MAX_IMAGE_SLIDES_UPLOAD = 20;

export default class FormData {
    // constructor for dropzone
    imageSlideDropzone = null;

    // this form is update form or not
    isUpdateForm = false;

    // is uploading image
    isUploadingImageSlides = false;

    // uploaded files list, append this when submit form
    uploadedFiles = [];

    constructor() {
        this.initEditor();
        this.initFormValidate();

        // init dropzone
        this.imageSlideDropzone = this.initImageSlideDropzone();

        // set form is update form or not
        this.isUpdateForm = !!$('input[name=id]').val();

        this.initReviewImageSlides();

        this.initEvents();
    }

    // init form validate
    initFormValidate() {
        let _this = this;

        // init jQuery Validation
        $(FORM_DATA).validate({
            messages: {
                image_file_upload: {
                    accept: "This field must be image type JPG/JPEG/PNG.",
                },
            },
            submitHandler: function (form) {
                console.log('from form');
                _this._onSubmitForm(form);

                return false;
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
        });
    }

    // init dropzone to upload multiple files
    initImageSlideDropzone() {
        let _this = this;
        let uploadToStoreUrl = $(FORM_DATA).data('upload-to-storage');

        const imageSlideDropzone = new Dropzone(".dropzone", {
            url: uploadToStoreUrl,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dictDefaultMessage:
                "Drag or drop files here to upload. <br> Allow: JPG/JPEG/PNG",
            acceptedFiles: ["image/png", "image/jpeg"].join(","), // <-- jpeg = jpeg/jpg
            parallelUploads: 5,
            maxFiles: MAX_IMAGE_SLIDES_UPLOAD,
            uploadMultiple: true, // upload multiple files in a request
            init: function () {
                // additional params when sending upload files request
                this.on("sending", function (file, xhr, formData) {
                    formData.append("path", 'product-slides/');

                    // disable form submit when sending files to storage
                    $(FORM_DATA).find('button[type=submit]').prop('disabled', true);
                });

                // enable submit form when complete sending files to storage
                this.on("successmultiple", function (file) {
                    // enable form submit when sending files to storage complete
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        $(FORM_DATA).find('button[type=submit]').prop('disabled', false);
                    }
                });

                // event when upload more files than 'maxFiles'
                this.on("maxfilesexceeded", function (file) {
                    this.removeFile(file);
                });

                // event after upload all files in a request completed
                this.on("successmultiple", function (file, response) {
                    // add to uploaded files
                    _this.uploadedFiles = [..._this.uploadedFiles, ...response.data];
                });

                // event call after file was added
                this.on("addedfile", function (file) {
                    // Capture the Dropzone instance as closure.
                    let _thisDropdown = this;

                    // list name of uploaded files
                    const acceptedFileNames = _thisDropdown.getAcceptedFiles().map(file => file.name);
                    const reviewImageSlides = $(REVIEW_IMAGE_SLIDES).find('.review-image');
                    const countUploadedFiles = acceptedFileNames.length + reviewImageSlides.length;

                    // remove and show message if upload same file
                    if (countUploadedFiles >= MAX_IMAGE_SLIDES_UPLOAD) {
                        _thisDropdown.removeFile(file);
                        _this._showImageSlidesErrorMsg(`maximum file upload was ${MAX_IMAGE_SLIDES_UPLOAD}`);

                        return false;
                    } else if (acceptedFileNames.includes(file.name)) {
                        _thisDropdown.removeFile(file);
                        _this._showImageSlidesErrorMsg(`'${file.name}' already uploaded`);

                        return false;
                    }

                    // Create the remove button
                    var removeButton = Dropzone.createElement(
                        '<button class="remove-button"><i class="fas fa-times"></i></button>'
                    );

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _thisDropdown.removeFile(file);

                        _this.uploadedFiles = _this.uploadedFiles.filter(uploadedFile => uploadedFile.original_name != file.name);

                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });

                // remove default error icon when upload file fail
                this.on("error", function (file, errorMessage) {
                    var myPreview = document.getElementsByClassName("dz-error");

                    myPreview = myPreview[myPreview.length - 1];
                    myPreview.classList.toggle("dz-error");
                    myPreview.classList.toggle("dz-success");
                });
            },
        });

        return imageSlideDropzone;
    }

    // init review image slides
    initReviewImageSlides() {
        const productSlidesData = $(REVIEW_IMAGE_SLIDES).data('json');

        productSlidesData.map(productSlide => {
            $(REVIEW_IMAGE_SLIDES).append(`
                <div class="review-image mr-2 mb-2" data-id="${productSlide.id}">
                    <img src="${productSlide.full_path_image}" />
                    <button class="remove-button"><i class="fas fa-times"></i></button>
                </div>
            `);
        });
    }

    // init events
    initEvents() {
        this._onClickRemoveButtonOnReviewImageSlide();
    }

    // event when submit form
    _onSubmitForm(form) {
        // invalid files (not valid file types, upload fail...)
        let rejectedFiles = this.imageSlideDropzone.getRejectedFiles();
        let acceptedFiles = this.imageSlideDropzone.getAcceptedFiles();

        // if have rejected files
        if (rejectedFiles.length > 0) {
            rejectedFiles.map((file) => {
                // append rejected file message
                this._showImageSlidesErrorMsg(`'${file.name}' was invalid file types`);
            });

            return false;
        }
        // on create form, error if not upload any files
        else if (acceptedFiles.length < 1 && !this.isUpdateForm) {
            // append required field
            this._showImageSlidesErrorMsg('This field is required');

            return false;
        }

        // append uploaded image slides
        $(`<input name='image_slides_uploaded' type='hidden' value='${JSON.stringify(this.uploadedFiles)}' />`).appendTo(FORM_DATA);

        // append keep image slides
        let keepProductSlideIds = $(REVIEW_IMAGE_SLIDES).find('.review-image').map((i,e) => $(e).data('id')).toArray().join(',');
        $(`<input name='keep_product_slide_ids' type='hidden' value='${keepProductSlideIds}' />`).appendTo(FORM_DATA);

        // submit form
        form.submit();
    }

    // show error message for 'Image Slides' field
    _showImageSlidesErrorMsg(message) {
        // clear messages
        $(IMAGE_SLIDES).parent().find("label.invalid-feedback").remove();

        // append error message
        $(IMAGE_SLIDES).parent().append(`<label class="error invalid-feedback d-block"> ${message}. </label>`);
    }

    // event on click remove button on review image slide
    _onClickRemoveButtonOnReviewImageSlide() {
        $(REVIEW_IMAGE_SLIDES).on('click', '.remove-button', function (e) {
            e.preventDefault();

            $(this).parent().remove();
        });
    }
}
