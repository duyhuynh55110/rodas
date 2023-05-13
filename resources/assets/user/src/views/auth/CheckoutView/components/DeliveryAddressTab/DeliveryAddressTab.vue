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
                    :value="name"
                    @input="$emit('update:name', $event.target.value)"
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
                    :value="email"
                    @input="$emit('update:email', $event.target.value)"
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
                            :value="zipCode"
                            @input="$emit('update:zipCode', $event.target.value)"
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
                            :value="city"
                            @input="$emit('update:city', $event.target.value)"
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
                            :value="countryId"
                            @change="$emit('update:countryId', $event.target.value)"
                        >
                            <option value="0">Month</option>
                            <option value="1" selected>January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
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
                            :value="phoneNumber"
                            @input="$emit('update:phoneNumber', $event.target.value)"
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
