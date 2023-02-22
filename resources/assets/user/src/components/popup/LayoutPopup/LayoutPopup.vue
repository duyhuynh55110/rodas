<template>
    <vue-final-modal
        v-model="showModal"
        :name="modalName"
        classes="modal-container"
        content-class="modal-content"
    >
        <!-- Title -->
        <span class="modal__title">
            <slot name="title"></slot>
        </span>

        <!-- Content -->
        <div class="modal__content">
            <slot name="content"></slot>

            <div class="modal-control">
                <button class="btn btn-secondary" @click="onClickCancelBtn"> {{ $t('cancel') }} </button>
                <button class="btn btn-primary" @click="$emit('clickConfirmBtn')"> {{ $t('ok') }} </button>
            </div>
        </div>
    </vue-final-modal>
</template>

<style src="./LayoutPopup.scss" lang="scss" scoped></style>
<script src="./LayoutPopup.js"></script>
