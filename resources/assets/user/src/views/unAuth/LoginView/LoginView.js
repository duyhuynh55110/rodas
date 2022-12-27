import { AuthLayout } from "@/layouts"
import * as yup from 'yup';

// components
import { Form, Field, ErrorMessage } from 'vee-validate';
import { ButtonPrimary } from "@/components"
import { authService } from "@/services";
import { STATUS_CODE_OK } from "@/utils/constants";

export default {
    name: "LoginView",
    components: {
        Form,
        Field,
        ErrorMessage,
        ButtonPrimary,
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
        onSubmitForm: async function (values, actions) {
            // start confirm
            this.disabledBtn = true;

            const { status } = await authService.login(this.email, this.password);

            // show error if login failed
            if (status != STATUS_CODE_OK) {
                actions.setFieldError('api-feedback', 'The username or password was not correct');

                this.disabledBtn = false;
                return;
            }

            // redirect if logged in
            this.$router.push({ name: 'home' });
        }
    }
}
