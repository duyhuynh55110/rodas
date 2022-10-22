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
        <Toolbar />
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
    },
};
</script>
