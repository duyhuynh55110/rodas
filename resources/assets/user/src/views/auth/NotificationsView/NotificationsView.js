import { computed } from "vue";
import { NAVBAR_STYLE_2 } from "@/utils/constants"

// components
import NotificationCardsList from "./components/NotificationCardsList";
import FilterCondition from "./components/FilterCondition";

// services
import { notificationService } from "@/services";
import { setPaginate, nextPage } from "@/utils/paginator";

const loadNotifications = async function (page, filter) {
    const response = await notificationService.getNotifications({
        ...filter,
        page,
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
            notifications: setPaginate(),
            filterNotifications: {},
        }
    },
    provide: function () {
        return {
            isLoadingData: computed(() => this.isLoadingData),
            notifications: computed(() => this.notifications),
            evtOnClickFilterButton: this.evtOnClickFilterButton,
        };
    },
    methods: {
        // load notifications list
        loadNotifications: async function () {
            // start fetching
            this.isLoadingData = true;

            // call api
            const { data, pagination } = await loadNotifications(nextPage(this.notificationsPagination), this.filterNotifications);

            // set state
            this.notifications = setPaginate(data, pagination);

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
    setup: async function () {
        const page = nextPage({});

        // fetch composition API
        const { data, pagination } = await loadNotifications(page, {});

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
