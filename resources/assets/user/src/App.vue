<template>
    <div class="page">
        <div :class="this.pageContentClass">
            <router-view v-slot="{ Component }">
                <transition name="route" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </div>

        <!-- Toolbar -->
        <Toolbar v-show="!this.viewFullScreen" />
    </div>
</template>

<script>
import { Toolbar } from "@/components";

export default {
    name: "App",
    components: {
        Toolbar,
    },
    computed: {
        pageContentClass() {
            return (
                "page-content " +
                (this.$route.meta.customPageContentClass || "")
            );
        },
        viewFullScreen() {
            return this.$route.meta.viewFullScreen || false;
        }
    },
};
</script>
