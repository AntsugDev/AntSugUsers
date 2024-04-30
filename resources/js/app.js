import './bootstrap';
import {createApp} from "vue";
import App from "./App.vue";

import router from './router/router.js'
import store from './store/store.js'
import vuetify from "./plugin/vuetify.js";
import firebase from "./plugin/firebase.js";

const app = createApp(App)
    .use(router)
    .use(vuetify)
    .use(store)
    .use(firebase)

app.mount('#app')
