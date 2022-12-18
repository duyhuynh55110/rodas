<template>
    <AuthLayout>
        <form id="loginForm">
            <div class="title-bar mb-20">
                <h3 class="dz-title ma-0 text-upper-first-letter"> {{ $t('sign in') }} </h3>
            </div>

            <div class="form-group reverse">
                <input
                    id="inputEmail"
                    autocomplete="off"
                    type="email"
                    class="form-control"
                    :placeholder="$helper.capitalizeFirstLetter($t('email address'))"
                />
                <label for="inputEmail"> {{ $t('email') }} </label>
            </div>

            <div class="form-group reverse mb-20">
                <input
                    id="inputPassword"
                    autocomplete="off"
                    type="password"
                    class="form-control"
                    :placeholder="$helper.capitalizeFirstLetter($t('password'))"
                />
                <label for="inputPassword"> {{ $t('password') }} </label>
            </div>

            <div class="form-group action">
                <ButtonPrimary :content="$t('sign in')" class="mb-15 text-uppercase" />
                <router-link to="/sign-up" class="sign-in text-upper-first-letter"> {{ $t('create an account') }} </router-link>
            </div>
        </form>
    </AuthLayout>
</template>

<script src="./LoginView.js"></script>
