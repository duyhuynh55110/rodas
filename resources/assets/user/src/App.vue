<template>
    <div class="page">
        <div :class="this.pageContentClass">
            <router-view v-slot="{ Component }">
                <template v-if="Component">
                    <transition name="route" mode="out-in">
                        <Suspense timeout="0">
                            <!-- main page -->
                            <component :is="Component" />

                            <!-- screen loading -->
                            <template #fallback>
                                <ScreenLoading />
                            </template>
                        </Suspense>
                    </transition>
                </template>
            </router-view>
        </div>
    </div>
</template>

<script>
import { Toolbar, ScreenLoading } from "@/components";

export default {
    name: "App",
    components: {
        Toolbar,
        ScreenLoading,
    },
    watch: {
        $route: {
            immediate: true,
            handler(to) {
                // handle page title show on browser
                document.title = to.meta.title || "Rodas";
            },
        },
    },
    computed: {
        pageContentClass() {
            return (
                "page-content " +
                (this.$route.meta.customPageContentClass || "")
            );
        },
        showToolbar() {
            // not show toolbar if was page view full screen
            return !this.$route.meta.viewFullScreen;
        },
    },
};
</script>
