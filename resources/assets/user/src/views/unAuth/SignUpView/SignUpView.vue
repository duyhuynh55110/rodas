<template>
    <AuthLayout bannerSrc="https://i.pinimg.com/564x/ba/45/e3/ba45e38f91c915a6b2d15fa2d4ecb1b2.jpg">
        <form id="loginForm">
            <div class="title-bar mb-20">
                <h3 class="dz-title ma-0 text-upper-first-letter"> {{ $t('create your account') }} </h3>
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
                <ButtonPrimary
                    :content="$t('create an account')"
                    class="mb-15 text-uppercase"
                />
                <router-link to="/login" class="sign-in text-upper-first-letter"> {{ $t('sign in') }} </router-link>
            </div>
        </form>
    </AuthLayout>
</template>

<script src="./SignUpView.js"></script>
