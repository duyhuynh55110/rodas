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
            form: {
                name: '',
                email: '',
                zipCode: '',
                city: '',
                countryId: 0,
                phoneNumber: '',
                address: '',
            }
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
        onClickCompleteBtn: function () {
            alert('complete');
        }
    }
}
