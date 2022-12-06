export default {
    name: "ProductBox",
    props: {
        product: {
            type: Object,
            required: true,
        }
    },
    computed: {
        // active favorite icon if 'is_favorite' is true
        productBookmarkClass: function () {
            return {
                'product-bookmark': true,
                'active': this.product.is_favorite, // this product is favorite by current user
            }
        },
    },
    methods: {
        // event on click favorite icon
        onClickFavoriteIcon: async function () {
            await this.$emit('clickFavoriteIcon', this.product);
        }
    }
}
