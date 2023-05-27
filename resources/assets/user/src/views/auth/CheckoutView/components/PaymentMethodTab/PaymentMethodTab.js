// components
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: 'PaymentMethodTab',
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    props: ['formData'],
    data: function () {
        return {
            schema: yup.object({
                'address': yup.string().required(),
            }),
            isProcessing: false,
        }
    },
     emits: [
        'update:address',
        'complete'
    ],
    methods: {
        // event when submit form
        onSubmitForm: function () {
            // block click multiple
            this.isProcessing = true;

            this.$emit('complete', {
                fail: () => {
                    this.isProcessing = false;
                }
            });
            return false;
        },
    }
}
