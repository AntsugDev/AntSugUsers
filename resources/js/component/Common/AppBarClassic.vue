<template>
    <v-app-bar app color="primary" :clipped-left="true" class="elevation-1">
                    <v-app-bar-nav-icon  @click.stop="$store.commit('config/changeMini')" class="primary white--text"></v-app-bar-nav-icon>
                    <v-toolbar-title class="white--text text-uppercase font-weight-bold">Segnalazioni</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu v-model="userMenu" :close-on-content-click="true" :offset-y="true" bottom>
                        <template v-slot:activator="{props }">
                            <v-avatar color="primary" v-bind="props">
                                <v-icon dark>mdi-account-circle</v-icon>
                            </v-avatar>
                        </template>
                        <v-card>
                            <v-list>
                                <v-list-item prepend-icon="mdi-account">
                                    <v-list-item-title>{{ user.firstName +' '+user.lastName}}</v-list-item-title>
                                    <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
                                </v-list-item>
                            </v-list>
                            <v-list dense>
                                <v-list-item link @click="logout">
                                    <v-list-item-title>{{textLogout}}</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-card>
                    </v-menu>
                </v-app-bar>
</template>
<script>
import storeComputed from "../../mixins/storeComputed.js";

export default {
    name: "AppBarClassic",
    mixins:[storeComputed],
    props:['textLogout','user'],
    data: () => ({
        userMenu: false,
    }),
    methods:{
        logout: function (){
            this.$store.commit('user/deleteUser')
            this.$router.push({name : 'ChooseLogin', query: {errors:"Logout effettuato"} })
            localStorage.clear()
        },
    }
}
</script>
