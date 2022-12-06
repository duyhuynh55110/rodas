<template>
    <div class="profile-info-list">
        <ul>
            <li>
                <label class="title"> {{ $t('phone') }} </label>
                <span class="value"> Updating... </span>
            </li>
            <li>
                <label class="title"> {{ $t('email address') }} </label>
                <span class="value"> {{ auth.email }} </span>
            </li>
            <li>
                <label class="title"> {{ $t('shipping address') }} </label>
                <span class="value"> Updating... </span>
            </li>
            <li>
                <label class="title"> {{ $t('total order') }} </label>
                <span class="value"> Updating... </span>
            </li>
        </ul>
    </div>
</template>
<script src="./ProfileList.js"></script>
<style src="./ProfileList.scss" scoped lang="scss"></style>
