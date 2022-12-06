<template>
    <div class="menu-list">
        <ul>
            <li>
                <router-link
                    to="/profile"
                    class="button-large button button-fill"
                >
                    <img
                        class="icon"
                        :src="require('@/assets/img/svg/user.svg')"
                        alt=""
                    />
                    {{ $t('my profile') }}
                </router-link>
            </li>
            <li>
                <router-link
                    to="/notifications"
                    class="button-large button button-fill"
                >
                    <img
                        class="icon"
                        :src="require('@/assets/img/svg/star.svg')"
                        alt=""
                    />
                    {{ $t('notifications') }}
                </router-link>
            </li>
            <li>
                <router-link
                    to="/logout"
                    class="button-large button button-fill"
                >
                    <img
                        class="icon"
                        :src="require('@/assets/img/svg/clipboard.svg')"
                        alt=""
                    />
                    {{ $t('logout') }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<style src="./MenuList.scss" scoped lang="scss"></style>
<script src="./MenuList.js"></script>
