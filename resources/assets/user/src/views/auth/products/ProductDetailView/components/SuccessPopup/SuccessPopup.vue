<template>
    <vue-final-modal
        v-model="showModal"
        name="successPopup"
        classes="modal-container"
        content-class="modal-content"
    >
        <!-- Close button -->
        <button class="modal__close" @click="showModal = false">
            <font-awesome-icon icon="fa-solid fa-xmark" />
        </button>

        <!-- Content -->
        <div class="modal__content">
            <slot name="content"></slot>
        </div>
    </vue-final-modal>
</template>

<style src="./SuccessPopup.scss" lang="scss" scoped></style>
<script src="./SuccessPopup.js"></script>
