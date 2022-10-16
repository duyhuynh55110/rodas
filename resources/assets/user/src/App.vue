<template>
    <div :class="this.pageClass">
        <!-- Navbar -->
        <!-- <Navbar /> -->

        <div class="page-content">
            <router-view v-slot="{ Component }">
                <transition name="route" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </div>

        <!-- Toolbar -->
        <Toolbar />
    </div>
</template>

<style lang="scss">
@import "@/scss/main.scss";
</style>

<script>
import { Toolbar } from "@/components";

export default {
    name: "App",
    components: {
        Toolbar,
        // Navbar,
    },
    computed: {
        pageClass() {
            return "page " + (this.$route.meta.customPageClass || "");
        },
    },
};
</script>
