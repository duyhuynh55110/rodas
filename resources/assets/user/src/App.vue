<template>
    <div class="page">
        <div class="page-content">
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
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

/* route transitions */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

<script>
import { Toolbar } from "@/components";

export default {
    name: "App",
    components: {
        Toolbar,
    },
};
</script>
