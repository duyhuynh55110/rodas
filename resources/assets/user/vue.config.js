const { defineConfig } = require("@vue/cli-service");
const path = require("path");

module.exports = defineConfig({
    transpileDependencies: true,
    configureWebpack: {
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "src/"),
                "@views": path.resolve(__dirname, "src/views"),
                "@assets": path.resolve(__dirname, "src/assets"),
                "@constants": path.resolve(__dirname, "src/constants"),
                "@router": path.resolve(__dirname, "src/router"),
                "@services": path.resolve(__dirname, "src/services"),
                "@components": path.resolve(__dirname, "src/components"),
            },
        },
    },
});
