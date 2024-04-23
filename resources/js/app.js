import './bootstrap';
import {createApp} from "vue";
import App from "./App.vue";

import router from './router/router.js'
import store from './store/store.js'
import vuetify from "./plugin/vuetify.js";

const app = createApp(App)
    .use(router)
    .use(vuetify)
    .use(store)
app.mount('#app')
