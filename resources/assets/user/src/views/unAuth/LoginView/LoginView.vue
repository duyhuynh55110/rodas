<template>
    <AuthLayout>
        <Form
            @submit="onSubmitForm"
            :validation-schema="schema"
            v-slot="{ errors }">
            <div class="title-bar mb-20">
                <h3 class="dz-title ma-0 text-upper-first-letter"> {{ $t('sign in') }} </h3>
            </div>

            <div class="form-group reverse">
                <ErrorMessage name="email" class="invalid-feedback" />
                <Field name="email" v-model="email" :class="inputClass(errors.email)" :placeholder="$helper.capitalizeFirstLetter($t('email address'))" autocomplete="off" />
                <label for="inputEmail"> {{ $t('email') }} </label>
            </div>

            <div class="form-group reverse">
                <ErrorMessage name="password" class="invalid-feedback" />
                <Field name="password" v-model="password" :class="inputClass(errors.password)" :placeholder="$helper.capitalizeFirstLetter($t('password'))" type="password" autocomplete="off" />
                <label for="inputPassword"> {{ $t('password') }} </label>
            </div>

            <div class="form-group mb-20">
                <ErrorMessage name="api-feedback" class="invalid-feedback" />
            </div>

            <div class="form-group action">
                <button type="submit" class="button button-fill button-large mb-15 text-uppercase" :disabled="disabledBtn">{{ $t('sign in') }}</button>
                <router-link :to="{ name: 'register' }" class="sign-in text-upper-first-letter"> {{ $t('create an account') }} </router-link>
            </div>
        </form>
    </AuthLayout>
</template>

<script src="./LoginView.js"></script>
