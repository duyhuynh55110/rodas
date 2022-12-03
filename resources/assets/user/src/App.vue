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
        <Toolbar v-show="this.showToolbar" />
    </div>
</template>

<script>
import { mapState } from "vuex";
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
        ...mapState('app', [
            'isPageLoading',
        ]),
        pageContentClass() {
            return (
                'page-content ' +
                (this.$route.meta.customPageContentClass || '')
            );
        },
        showToolbar() {
            //  not show toolbar when page loading
            if(this.isPageLoading) {
                return false;
            }

            // not show toolbar if was page view full screen
            return !this.$route.meta.viewFullScreen;
        }
    },
};
</script>
