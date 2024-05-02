import {createRouter, createWebHistory} from "vue-router";
import Login from "../general/Login.vue";
import Home from "../general/Home.vue";
import store from "../store/store.js";
import moment from "moment";
import Index from "../component/Task/Index.vue";
import Pagination from "../component/Pagination/Pagination.vue";
import Keycloack from "../Keycloack/Keycloack.vue";
import Project from "../component/Task/Project/Project.vue";

const router = createRouter({
    history:createWebHistory(store.getters['config/appBasePath']),
    routes:[
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/keycloack',
            component:Keycloack,
            name: 'Keycloack'
        },
        {
            path: '/',
            name: 'Home',
            component: Home,
            beforeEnter:(to,from,next) => {
                let $jwt              = store.getters['user/getJwt'];
                let $auth             = $jwt.access_token !== null
                let $expired          = $jwt.expired;
                let $now    = moment();
                if(!$auth){
                    next({ name: 'Login'});
                }else{
                    if($expired > $now){
                        next();
                    }else
                        next({ name: 'Login' ,query:{_e:"Session exipred"}});
                }
            },
            children:[

                {
                    path:'task',
                    name:'IndexTask',
                    component:Index,
                    children:[


                    ]
                },
                {
                    path: 'pagination',
                    component:Pagination,
                    name: 'Pagination'
                },
                {
                    path: 'project',
                    component:Project,
                    name: 'Project'
                }
            ]

        },



        {
            path: '/:pathMatch(.*)*',
            redirect: { name: 'Login'},
        }
    ]
})
export default router;
