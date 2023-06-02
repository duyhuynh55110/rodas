import { countryService, orderIssueService } from '@/services';
import { STATUS_CODE_EMPTY_CART_PRODUCTS } from '@/utils/constants';

// components
import DeliveryAddressTab from './components/DeliveryAddressTab/DeliveryAddressTab.vue';
import PaymentMethodTab from './components/PaymentMethodTab/PaymentMethodTab.vue';

export default {
    name: "CheckoutView",
    components: {
        DeliveryAddressTab,
        PaymentMethodTab,
    },
    data() {
        return {
            currentActiveTabIndex: 0, // active tab's index
            tabs: [
                {
                    stickyName: this.$t('shipping address'),
                },
                {
                    stickyName: this.$t('payment method'),
                },
            ],
            formData: {
                name: '',
                email: '',
                zip_code: '',
                city: '',
                country_id: 1,
                phone: '',
                address: '',
            },
        }
    },
    methods: {
        // current active tab
        activeTab: function (tabIndex) {
            return tabIndex === this.currentActiveTabIndex
        },
        // sticky's class
        stickyClass: function (tabIndex) {
            return {
                'active': this.activeTab(tabIndex),
                'complete': tabIndex < this.currentActiveTabIndex
            }
        },
        // emit event when click 'Next' button on 'DeliveryAddressTab' component
        nextStep: function () {
            this.currentActiveTabIndex++;
        },
        // custom event when click back button
        onClickBackBtn: function () {
            // back previous page
            if(this.currentActiveTabIndex <= 0) {
                this.$router.go(-1);
                return;
            }

            this.currentActiveTabIndex--;
        },
        // emit event when click 'Submit' button on 'PaymentMethodTab' component
        onClickCompleteBtn: async function ({ fail }) {
            await orderIssueService.createOrder(this.formData)
            .then(
                () => {
                    this.$router.push({
                        path: '/'
                    })
                }
            )
            .catch(
                (error) => {
                    const statusCode = error.response?.data?.code;

                    if(statusCode == STATUS_CODE_EMPTY_CART_PRODUCTS) {
                        alert('cart empty');
                    }

                    fail();
                }
            )
        },
    },
    setup: async function () {
        const { data } = await countryService.getCountries();

        // master data
        return {
            countries: data,
        }
    },
    created: async function () {
        this.formData.name = this.$auth.getUser().name;
        this.formData.email = this.$auth.getUser().email;
    }
}
