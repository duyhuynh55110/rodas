export default {
    name: "ProductBox",
    props: {
        product: {
            type: Object,
            required: true,
        }
    },
    computed: {
        productBookmarkClass: function () {
            return {
                'product-bookmark': true,
                'active': this.product.is_favorite, // this product is favorite by current user
            }
        },
    },
    methods: {
        onClickFavoriteIcon: async function (e) {
            this.$emit('clickFavoriteIcon', e);
        }
    }
}
