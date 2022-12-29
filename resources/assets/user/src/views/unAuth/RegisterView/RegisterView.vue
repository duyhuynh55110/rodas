<template>
    <AuthLayout bannerSrc="https://i.pinimg.com/564x/ba/45/e3/ba45e38f91c915a6b2d15fa2d4ecb1b2.jpg">
        <Form
            @submit="onSubmitForm"
            :validation-schema="schema"
            v-slot="{ errors }">

            <!-- Title -->
            <div class="title-bar mb-20">
                <h3 class="dz-title ma-0 text-upper-first-letter"> {{ $t('create your account') }} </h3>
            </div>

            <!-- Name -->
            <div class="form-group reverse">
                <ErrorMessage name="name" class="invalid-feedback" />
                <Field
                    id="inputName"
                    name="name"
                    type="name"
                    v-model="name"
                    :class="inputClass(errors.name)"
                    :placeholder="$helper.capitalizeFirstLetter($t('name'))"
                    autocomplete="off" />
                <label for="inputName"> {{ $t('name') }} </label>
            </div>

            <!-- Email -->
            <div class="form-group reverse">
                <ErrorMessage name="email" class="invalid-feedback" />
                <Field
                    id="inputEmail"
                    name="email"
                    type="email"
                    v-model="email"
                    :class="inputClass(errors.email)"
                    :placeholder="$helper.capitalizeFirstLetter($t('email address'))"
                    autocomplete="off" />
                <label for="inputEmail"> {{ $t('email') }} </label>
            </div>

            <!-- Password -->
            <div class="form-group reverse mb-20">
                <ErrorMessage name="password" class="invalid-feedback" />
                <Field
                    id="inputPassword"
                    name="password"
                    v-model="password"
                    :class="inputClass(errors.password)"
                    :placeholder="$helper.capitalizeFirstLetter($t('password'))"
                    type="password"
                    autocomplete="off" />
                <label for="inputPassword"> {{ $t('password') }} </label>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group reverse mb-20">
                <ErrorMessage name="password_confirmation" class="invalid-feedback" />
                <Field
                    id="inputPasswordConfirmation"
                    name="password_confirmation"
                    v-model="passwordConfirmation"
                    :class="inputClass(errors.password_confirmation)"
                    :placeholder="$helper.capitalizeFirstLetter($t('password confirmation'))"
                    type="password"
                    autocomplete="off" />
                <label for="inputPasswordConfirmation"> {{ $t('password confirmation') }} </label>
            </div>

            <!-- Message from server -->
            <div class="form-group mb-20">
                <ErrorMessage name="api-feedback" class="invalid-feedback" />
            </div>

            <div class="form-group action">
                 <button type="submit" class="button button-fill button-large mb-15 text-uppercase" :disabled="disabledBtn">{{ $t('create an account') }}</button>
                <router-link to="/login" class="sign-in text-upper-first-letter"> {{ $t('sign in') }} </router-link>
            </div>
        </form>
    </AuthLayout>
</template>

<script src="./RegisterView.js"></script>
