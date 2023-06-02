import { authService } from "@/services";
import * as yup from 'yup';
import { STATUS_CODE_OK } from "@/utils/constants";

// components
import { AuthLayout } from "@/layouts";
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    name: "RegisterView",
    components: {
        Form,
        Field,
        ErrorMessage,
        AuthLayout,
    },
    data() {
        return {
            disabledBtn: false,
            name: '',
            email: '',
            password: '',
            passwordConfirmation: '',
            schema: yup.object({
                name: yup.string().required(),
                email: yup.string().required().email(),
                password: yup.string().required().min(6),
                password_confirmation: yup.string().oneOf([yup.ref('password'), null], 'Passwords must match')
            })
        }
    },
    methods: {
        // handle input[type=text] class
        inputClass: function (error) {
            return {
                'form-control': true,
                'is-invalid': error,
            }
        },
        // event on submit register form
        onSubmitForm: async function (values, actions) {
            // start confirm
            this.disabledBtn = true;

            const { status, message } = await authService.register(this.name, this.email, this.password, this.passwordConfirmation);

            // show error if login failed
            if (status != STATUS_CODE_OK) {
                actions.setFieldError('api-feedback', message);

                this.disabledBtn = false;
                return;
            }

            // redirect if logged in
            this.$router.push({ name: 'home' });
        }
    }
}
