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
    watch: {
        $route: {
            immediate: true,
            handler(to) {
                // handle page title show on browser
                document.title = to.meta.title || 'Rodas';
            }
        },
    },
    computed: {
        pageContentClass() {
            return (
                'page-content ' +
                (this.$route.meta.customPageContentClass || '')
            );
        },
        viewFullScreen() {
            return this.$route.meta.viewFullScreen || false;
        }
    },
};
</script>
