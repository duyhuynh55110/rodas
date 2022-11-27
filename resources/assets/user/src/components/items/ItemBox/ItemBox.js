export default {
    name: "ItemBox",
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    computed: {
        itemBookmarkClass: function () {
            return {
                'item-bookmark': true,
                'active': this.item.is_favorite, // this item is favorite by current user
            }
        },
    },
    methods: {
        onClickFavoriteIcon: async function () {
            await this.$store.dispatch('products/createFavorite', this.item.id);
        }
    }
}
