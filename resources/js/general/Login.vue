<template>
    <v-app>
        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <SnackBarCommon></SnackBarCommon>
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="primary"
                                dark
                                flat
                                dense
                            >
                                <v-toolbar-title color="secondary" class="font-weight-bold">ACCESSO</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" class="py-0">
                                            <v-form ref="form" v-model="valid">
                                                <v-text-field
                                                    :disabled="loading" color="primary" label="email" name="email"
                                                    prepend-icon="mdi-at"
                                                    v-model="email"
                                                    :rules="[value => !!value || 'Devi inserire l\'email',rules.email]"
                                                    type="email"
                                                ></v-text-field>
                                                <v-text-field
                                                    :disabled="loading" color="primary" id="password" label="Password"
                                                    name="password" prepend-icon="mdi-lock"
                                                    v-model="password"
                                                    :rules="[value => !!value || 'Devi inserire la password']"
                                                    type="password"
                                                ></v-text-field>
                                            </v-form>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="primary"
                                    class="font-weight-bold" width="100%" dark @click="login"
                                    :disabled="loading">
                                    Accedi
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import SnackBarCommon from "../component/Common/SnackBarCommon.vue";
import {axiosInstance, POST} from "../plugin/instance.api.js";
import storeComputed from "../mixins/storeComputed.js";

export default {
    name: "Login",
    components: {SnackBarCommon},
    mixins:[storeComputed],
    data:()=> ({
        valid: false,
        loading:false,
        email:null,
        password:null,
        rules: {
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return pattern.test(value) || 'Devi inserire un indirizzo email valido'
            },
        },
    }) ,
    methods:{
        login:function (){
            this.loading = true
            this.$refs.form.validate().then(r => {
                if(r.valid){
                    const formdata = new FormData();
                    formdata.append("grant_type", "client_credentials");
                    formdata.append("client_id", this.config.oauthPasswordClient.id);
                    formdata.append("client_secret", this.config.oauthPasswordClient.secret);
                    formdata.append("username", this.email);
                    formdata.append("password", this.password);
                    formdata.append("scope", "*");

                    axiosInstance('/oauth/token',POST,formdata).then(r => {
                        this.loading = false;
                        this.$store.commit('user/token',r.data)
                        this.$router.push({name:'Home'});
                    }).catch(e => {
                        this.loading = false
                    })
                }else
                    this.loading = false
            })

        }
    }
}
</script>

