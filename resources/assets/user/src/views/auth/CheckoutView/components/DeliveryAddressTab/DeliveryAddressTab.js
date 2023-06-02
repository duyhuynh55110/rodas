// components
import { DEFAULT_COUNTRY_ID_SELECTED } from '@/utils/constants';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: "DeliveryAddressTab",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    props: ['formData', 'countries'],
    data: function () {
        return {
            schema: yup.object({
                'full-name': yup.string().required(),
                'email': yup.string().required().email(),
                'zip-code': yup.number().typeError(this.$t('you must specify a number')),
                'city': yup.string().required(),
                'country': yup.number().required(),
                'phone': yup.string().matches(/\b\d{9,10}\b/, {message: 'phone must have length from 9 to 10', excludeEmptyString: true}).required(),
            }),
            selected: DEFAULT_COUNTRY_ID_SELECTED,
        }
    },
    methods: {
        onSubmitForm: function () {
            this.$emit('nextStep');

            // prevent page refresh
            return false;
        }
    }
}
