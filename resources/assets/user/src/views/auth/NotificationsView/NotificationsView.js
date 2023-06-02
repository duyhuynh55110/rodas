import { computed } from "vue";
import { NAVBAR_STYLE_2, PER_PAGE_DEFAULT } from "@/utils/constants"

// components
import NotificationCardsList from "./components/NotificationCardsList/NotificationCardsList.vue";
import FilterCondition from "./components/FilterCondition/FilterCondition.vue";

// services
import { notificationService } from "@/services";
import { setPaginate, nextPage } from "@/utils/paginator";

// fetch notifications list
const fetchNotifications = async function (page, filter) {
    const response = await notificationService.getNotifications({
        ...filter,
        page,
        per_page: PER_PAGE_DEFAULT,
    });

    return response;
}

export default {
    name: "NotificationsView",
    components: {
        NotificationCardsList,
        FilterCondition
    },
    data: function () {
        return {
            isLoadingData: false,
            notifications: {},
            filterNotifications: {},
        }
    },
    provide: function () {
        return {
            isLoadingData: computed(() => this.isLoadingData),
            evtOnClickFilterButton: this.evtOnClickFilterButton,
        };
    },
    methods: {
        // load notifications list
        loadNotifications: async function (page) {
            // start fetching
            this.isLoadingData = true;

            // call api
            const { data, pagination } = await fetchNotifications(page, this.filterNotifications);

            // set state
            this.notifications = setPaginate(data, pagination);

            // end fetching
            this.isLoadingData = false;
        },
        // event on click filter button -> filter list by condition
        evtOnClickFilterButton: async function (filterNotifications) {
            const page = nextPage(); // page 1

            // reset state
            this.filterNotifications = filterNotifications;

            await this.loadNotifications(page);
        }
    },
    setup: async function () {
        const page = nextPage({});

        // fetch composition API
        const { data, pagination } = await fetchNotifications(page, {});

        // master data
        return {
            navbarStyle: NAVBAR_STYLE_2,
            dfNotifications: setPaginate(data, pagination), // default 'notifications' state value
        };
    },
    created: function () {
        this.notifications = setPaginate(this.dfNotifications.data, this.dfNotifications.pagination);
    }
}
