<template>
    <div>
        <Form
            @submit="onSubmitForm"
            :validation-schema="schema"
        >
            <!-- Full Name -->
            <div class="form-group">
                <label for="inputFullName"> {{ $t('full name') }} </label>
                <Field
                    id="inputFullName"
                    name="full-name"
                    :placeholder="$helper.capitalizeFirstLetter($t('full name'))"
                    autocomplete="off"
                    v-model="formData.name"
                />
                <ErrorMessage name="full-name" class="invalid-feedback" />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="inputEmail"> {{ $t('email') }} </label>
                <Field
                    id="inputEmail"
                    name="email"
                    :placeholder="$helper.capitalizeFirstLetter($t('email'))"
                    autocomplete="off"
                    v-model="formData.email"
                />
                <ErrorMessage name="email" class="invalid-feedback" />
            </div>

            <div class="row">
                <!-- Zip Code -->
                <div class="col-40">
                    <div class="form-group">
                        <label for="inputZipCode"> {{ $t('zip code') }} </label>
                        <Field
                            id="inputZipCode"
                            name="zip-code"
                            :placeholder="$helper.capitalizeFirstLetter($t('zip code'))"
                            autocomplete="off"
                            v-model="formData.zip_code"
                        />
                        <ErrorMessage name="zip-code" class="invalid-feedback" />
                    </div>
                </div>

                <!-- City -->
                <div class="col-60">
                    <div class="form-group">
                    <label for="inputCity"> {{ $t('city') }} </label>
                        <Field
                            id="inputCity"
                            name="city"
                            :placeholder="$helper.capitalizeFirstLetter($t('city'))"
                            autocomplete="off"
                            v-model="formData.city"
                        />
                        <ErrorMessage name="city" class="invalid-feedback" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-40">
                    <!-- Country -->
                    <div class="form-group">
                        <label for="inputCountry"> {{ $t('country') }} </label>
                        <Field
                            id="inputCountry"
                            name="country"
                            as="select"
                            v-model="formData.country_id"
                        >
                            <option v-for="(country, index) in countries" :key="index" :value="country.id"> {{ country.name }} </option>
                        </Field>
                        <ErrorMessage name="country" class="invalid-feedback" />
                    </div>
                </div>

                <div class="col-60">
                    <!-- Phone -->
                    <div class="form-group">
                        <label for="inputPhone"> {{ $t('phone') }} </label>
                        <Field
                            id="inputPhone"
                            name="phone"
                            type="number"
                            :placeholder="$helper.capitalizeFirstLetter($t('phone'))"
                            autocomplete="off"
                            v-model="formData.phone"
                        />
                        <ErrorMessage name="phone" class="invalid-feedback" />
                    </div>
                </div>
            </div>

            <!-- Next button -->
            <button class="button-large button button-fill text-upper-first-letter"> {{ $t('next') }} </button>
        </Form>
    </div>
</template>

<script src="./DeliveryAddressTab.js"></script>
<style src="./DeliveryAddressTab.scss" lang="scss" scoped></style>
