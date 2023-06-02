export default {
    name: "AuthLayout",
    props: {
        bannerSrc: {
            type: String,
            default: "https://i.pinimg.com/564x/f1/a7/6a/f1a76a02514fa7d9e5402563cac1bf16.jpg",
        },
    },
    computed: {
        getBannerStyle() {
            return `background-image: url(${this.bannerSrc});`;
        }
    }
}
