const { defineConfig } = require("@vue/cli-service");
const path = require("path");

module.exports = defineConfig({
    transpileDependencies: true,
    configureWebpack: {
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "src/"),
            },
        },
    },
    css: {
        loaderOptions: {
            scss: {
                additionalData: `
                @import "@/scss/abstracts/variables";
                @import "@/scss/abstracts/mixins";
                `,
            },
        },
    },
});
