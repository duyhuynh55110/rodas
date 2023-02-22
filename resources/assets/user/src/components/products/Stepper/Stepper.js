export default {
    name: "Stepper",
    props: {
        dfQuantity: {
            type: Number,
            required: false,
        }
    },
    data: function () {
        return {
            quantity: 1,
        }
    },
    emits: ['update:quantity', 'removeProduct'],
    watch: {
        // https://v3-migration.vuejs.org/breaking-changes/v-model.html#v-model-arguments
        quantity: {
            handler: function (newValue, oldValue) {
                if(!Number.isInteger(newValue) && this.quantity != '') {
                    this.quantity = oldValue;
                }

                this.$emit('update:quantity', newValue);
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
                if (this.quantity <= 0) {
                    this.quantity = 1;
                    this.$emit('removeProduct');
                }
            } else {
                // plus
                this.quantity++;
            }
        },
        onFocusoutInputQuantity: function () {
            if(!this.quantity) {
                this.quantity = 1;
            }
        }
    },
    created: function () {
        if(this.dfQuantity) {
            this.quantity = this.dfQuantity;
        }
    }
}
