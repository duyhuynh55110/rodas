// components
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: "DeliveryAddressTab",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    props: {
        name: String,
        email: String,
        zipCode: String,
        city: String,
        countryId: Number,
        phoneNumber: String,
    },
    data: function () {
        return {
            schema: yup.object({
                'full-name': yup.string().required(),
                'email': yup.string().required().email(),
                'zip-code': yup.number().typeError(this.$t('you must specify a number')),
                'city': yup.string().required(),
                'country': yup.number().required(),
                'phone': yup.number().typeError(this.$t('you must specify a number')),
            })
        }
    },
    emits: [
        'update:name',
        'update:email',
        'update:zipCode',
        'update:city',
        'update:countryId',
        'update:phoneNumber',
        'nextStep'
    ],
    methods: {
        onSubmitForm: function () {
            this.$emit('nextStep');

            // prevent page refresh
            return false;
        }
    }
}
