import { computed } from "vue";
import { NAVBAR_STYLE_2 } from "@/utils/constants"

// components
import NotificationCardsList from "./components/NotificationCardsList";
import FilterCondition from "./components/FilterCondition";

// store
import { mapState } from "vuex";

// services
import { notificationService } from "@/services";
import { nextPage } from "@/utils/helper";

export default {
    name: "NotificationsView",
    components: {
        NotificationCardsList,
        FilterCondition
    },
    data: function () {
        return {
            navbarStyle: NAVBAR_STYLE_2,
            notifications: [],
            notificationsPagination: {},
            filterNotifications: {},
            isLoadingData: false,
        }
    },
    provide: function () {
        return {
            isLoadingData: computed(() => this.isLoadingData),
            notifications: computed(() => this.notifications),
            evtOnClickFilterButton: this.evtOnClickFilterButton,
        };
    },
    computed: {
        ...mapState("app", ["isPageLoading"]),
    },
    methods: {
        // load notifications list
        loadNotifications: async function () {
            // start fetching
            this.isLoadingData = true;

            // call api
            const { data, pagination } = await notificationService.getNotifications({
                ...this.filterNotifications,
                page: nextPage(this.notificationsPagination),
            });

            // set state
            this.notifications = data;
            this.notificationsPagination = pagination;

            // end fetching
            this.isLoadingData = false;
        },
        // event on click filter button -> filter list by condition
        evtOnClickFilterButton: async function (filterNotifications) {
            // reset state
            this.notificationsPagination = {};
            this.filterNotifications = filterNotifications;

            await this.loadNotifications();
        }
    },
    created: async function() {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // fetch data
        await this.loadNotifications();

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
}
