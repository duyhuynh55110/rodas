import { createI18n } from 'vue-i18n';
import en from './en';
import vn from './vn';

// Create VueI18n instance with options
const i18n = createI18n({
    locale: "vn", // set locale
    messages: {
        en: en,
        vn: vn,
    }, // set locale messages
});

export default i18n;
