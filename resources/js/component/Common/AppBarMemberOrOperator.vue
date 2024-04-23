<template>

    <v-app-bar
        app
        color="#fed91f"
    >
<!--        <template v-slot:prepend>-->
<!--            <v-app-bar-nav-icon @click.stop="$store.commit('config/changeMini')" color="coldirettiGreen"></v-app-bar-nav-icon>-->
<!--        </template>-->
        <v-container>
            <v-layout row class="justify-space-between">
                <div style="width:52px"></div>
                <div class="align-self-center">
                    <a :href="href">
                        <v-img  width="auto" height="58px" :src="config.appUrl + '/img/logos/logo_coldiretti.png'"></v-img>
                    </a>
                </div>
                <v-menu
                    v-model="userMenu"
                    :close-on-content-click="true"
                    bottom
                    :offset-y="true"
                >
                    <template v-slot:activator="{ props }">
                        <v-avatar  v-bind="props" size="64" style="cursor: pointer">
                            <v-icon color="coldirettiGreen">mdi-account</v-icon>
                        </v-avatar>
                    </template>
                    <v-card>
                        <v-list>
                            <v-list-item prepend-icon="mdi-account">
                                <v-list-item-title>{{ user.firstName + ' ' + user.lastName }}
                                </v-list-item-title>
                                <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
                            </v-list-item>
                        </v-list>
                        <v-divider></v-divider>
                        <v-list dense>
                            <v-list-item link
                                         @click="logout">
                                <v-list-item-title> {{this.$store.getters['user/getRequestBackName'] !== null ? 'Torna a '+this.$store.getters['user/getRequestBackName'] : 'Esci'}}</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-card>
                </v-menu>
            </v-layout>
        </v-container>
    </v-app-bar>
</template>
<script>
import storeComputed from "../../mixins/storeComputed.js";
import NavigationDrawerCommon from "./NavigationDrawerCommon.vue";
import {getToken} from "../../router/route.service.js";

export default {
    name: "AppBarMemberOrOperator",
    components: {NavigationDrawerCommon},
    props:['href'],
    mixins:[storeComputed],
    data:() => ({
        userMenu: false,
        user: null
    }),
    methods:{
        logout:function (){
            if(this.$store.getters['user/getRequestBackName'] === undefined) {
                this.$store.commit('user/deleteUser')
                this.$router.push({name : 'ChooseLogin', query: {errors:"Logout effettuato"} })
            }else
                window.location.href = this.$store.getters['user/getRequestBackPath']
        }
    },
    mounted() {
        this.user       = this.$store.getters['user/getUser']
    }
}
</script>
