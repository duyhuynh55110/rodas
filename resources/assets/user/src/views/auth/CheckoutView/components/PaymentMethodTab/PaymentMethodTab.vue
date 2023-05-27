<template>
    <div>
        <!-- Choose payment method -->
        <div class="payment-methods">
            <div class="method active"> COD </div>
            <!-- <div class="method"> Credit Card </div> -->
        </div>

        <Form
            @submit="onSubmitForm"
            :validation-schema="schema"
        >
            <!-- Address -->
            <div class="form-group">
                <label for="inputAddress"> {{ $t('address') }} </label>
                <Field
                    id="inputAddress"
                    name="address"
                    :placeholder="$helper.capitalizeFirstLetter($t('address'))"
                    autocomplete="off"
                    v-model="formData.address"
                />
                <ErrorMessage name="address" class="invalid-feedback" />
            </div>

            <!-- Submit button -->
            <button class="button-large button button-fill text-upper-first-letter" :disabled="isProcessing"> {{ $t('confirm') }} </button>
        </Form>
    </div>
</template>

<script src="./PaymentMethodTab.js"></script>
<style src="./PaymentMethodTab.scss" lang="scss" scoped></style>
