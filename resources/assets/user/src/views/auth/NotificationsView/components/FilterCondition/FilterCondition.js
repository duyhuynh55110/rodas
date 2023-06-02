import { NOTIFICATION_IS_READ_OFF } from "@/utils/constants";

export default {
    name: "FilterConditions",
    data() {
        return {
            filterButtons: [
                {
                    text: 'All',
                    activeClass: true,
                    filter: {}
                },
                {
                    text: 'Unread',
                    activeClass: false,
                    filter: {
                        is_read: NOTIFICATION_IS_READ_OFF
                    }
                }
            ]
        }
    },
    inject: ['isLoadingData', 'evtOnClickFilterButton'],
    methods: {
        // event on click filter button
        onClickFilterButton: async function (index) {
            // remove 'active' class
            this.filterButtons.map((filterButton) => filterButton.activeClass = false);

            // add 'active' class to click button
            this.filterButtons[index].activeClass = true;

            await this.evtOnClickFilterButton(this.filterButtons[index].filter);
        }
    }
}
