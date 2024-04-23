import {createRouter, createWebHistory} from "vue-router";
import Login from "../general/Login.vue";
import Home from "../general/Home.vue";
import store from "../store/store.js";

const router = createRouter({
    history:createWebHistory(store.getters['config/appBasePath']),
    routes:[
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },

        {
            path: '/',
            name: 'Home',
            component: Home,
            beforeEnter:(to,from,next) => {
                if(!store.getters['user/getIsAuth'])
                    next({name:'Login'})
                next()
            }

        },



        {
            path: '/:pathMatch(.*)*',
            redirect: { name: 'Login'},
        }
    ]
})
export default router;
