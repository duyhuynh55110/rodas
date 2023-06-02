import { authService } from "@/services";
import { STATUS_CODE_OK } from "@/utils/constants";
import * as yup from 'yup';

// components
import { AuthLayout } from "@/layouts";
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    name: "LoginView",
    components: {
        Form,
        Field,
        ErrorMessage,
        AuthLayout,
    },
    data() {
        return {
            disabledBtn: false,
            email: '',
            password: '',
            schema: yup.object({
                email: yup.string().required().email(),
                password: yup.string().required().min(6),
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
        // event on submit login form
        onSubmitForm: async function (values, actions) {
            // start confirm
            this.disabledBtn = true;

            const { status, message } = await authService.login(this.email, this.password);

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
