<template>
    <v-app id="inspire">
        <ProgressBarCommon></ProgressBarCommon>
        <template v-if="!$store.getters['progress/getShow']">
            <SnackBarCommon></SnackBarCommon>
            <NavigationDrawerCommon ></NavigationDrawerCommon>
            <AppBarClassic :user="user" :text-logout="textLogout"></AppBarClassic>
            <v-main class="main-home">
                <router-view></router-view>
            </v-main>
        </template>

    </v-app>
</template>

<script>
import ProgressBarCommon from "../component/Common/ProgressBarCommon.vue";
import SnackBarCommon from "../component/Common/SnackBarCommon.vue";
import NavigationDrawerCommon from "../component/Common/NavigationDrawerCommon.vue";
import AppBarClassic from "../component/Common/AppBarClassic.vue";
import StoreComputed from "../mixins/storeComputed.js";
import LoginMixins from "../mixins/LoginMixins.js";

export default {
    name: "Home",
    components: {AppBarClassic, NavigationDrawerCommon, SnackBarCommon, ProgressBarCommon},
    mixins:[StoreComputed,LoginMixins],
    data: () => ({
        getWhoAmIRequest: {loading: true},
        userMenu: false,
        user:[],
        textLogout: "Esci",

    }),
    methods:{
        whoAmI: function(){
            this.$store.commit('progress/update',true)
            this.getWhoAmI()
                .then(response => {
                    this.$store.commit('user/update', {
                        isAuthenticated: true,
                        firstName: response.data.data.first_name,
                        lastName: response.data.data.last_name,
                        email: response.data.data.email,
                    });
                    this.user = this.$store.getters['user/getUser'];


                    this.$store.commit('progress/update',false)
                })
                .catch(error => {
                    this.$store.commit('progress/update',false)
                    this.$router.push({name:'Login',query:{_e: "Utente non autenticato"}})
                })
                .finally(() => {
                    this.$store.commit('progress/update',false)

                })
        }

    },
    created() {
        this.whoAmI()
    },
}
</script>
<style>
.v-main{
    background: #D0D3D4;
}

</style>

