export default {
    name: "Stepper",
    data: function () {
        return {
            quantity: 1,
        }
    },
    emits: ['update:quantity'],
    watch: {
        // https://v3-migration.vuejs.org/breaking-changes/v-model.html#v-model-arguments
        quantity: {
            handler: function (newValue, oldValue) {
                this.$emit('update:quantity', newValue);

                if(!Number.isInteger(newValue) && this.quantity != '') {
                    this.quantity = oldValue;
                }
            },
            immediate: true
        }
    },
    methods: {
        // event on click '-' btn or '+' btn
        onClickChangeQuantityBtn: function (type) {
            // minus
            if (type == '-') {
                this.quantity--;

                // minimum is 0
                if (this.quantity <= 0) this.quantity = 1;
                return;
            }

            // plus
            this.quantity++;
        },
        onFocusoutInputQuantity: function () {
            if(!this.quantity) {
                this.quantity = 1;
            }
        }
    }
}
