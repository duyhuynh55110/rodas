<template>
    <div :class="this.pageClass">
        <div class="page-content">
            <router-view v-slot="{ Component }">
                <transition name="route" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>

            <!-- Toolbar -->
            <Toolbar />
        </div>
    </div>
</template>

<style lang="scss">
@import "@/scss/styles.scss";
</style>

<script>
import { Toolbar } from "@/components";

export default {
    name: "App",
    components: {
        Toolbar,
    },
    computed: {
        pageClass() {
            return 'page ' + (this.$route.meta.customPageClass || '');
        }
    }
};
</script>
