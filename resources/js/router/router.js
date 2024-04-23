import {createRouter, createWebHistory} from "vue-router";
import Login from "../general/Login.vue";
import Home from "../general/Home.vue";
import store from "../store/store.js";
import moment from "moment";

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
                let $jwt              = store.getters['user/getJwt'];
                let $auth             = store.getters['user/getIsAuthenticated'];
                let $expired          = $jwt.expired;
                let $now    = moment();
                if(!$auth){
                    next({ name: 'Login'});
                }else{
                    if($expired > $now){
                        next();
                    }else
                        next({ name: 'Login' ,query:{errors:"Session exipred"}});
                }
            }

        },



        {
            path: '/:pathMatch(.*)*',
            redirect: { name: 'Login'},
        }
    ]
})
export default router;
