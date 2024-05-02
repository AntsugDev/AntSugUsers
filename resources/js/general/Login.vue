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

                                <v-container>
                                    <v-row>
                                        <v-col cols="12"><v-btn
                                            color="primary"
                                            variant="outlined"
                                            class="font-weight-bold" width="99%" dark @click="login"
                                            :disabled="loading">
                                            Accedi
                                        </v-btn></v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-btn
                                                color="google"
                                                variant="outlined"
                                                class="font-weight-bold"
                                                width="99%" dark @click="firebaseSSO"
                                                append-icon="mdi-google"
                                                :disabled="loading">
                                                Accedi con google
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-container>


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
import {GoogleAuthProvider ,getAuth,signInWithPopup } from "firebase/auth";
import firebase from "../plugin/firebase.js";
import Google from "../mixins/Google.js";
export default {
    name: "Login",
    components: {SnackBarCommon},
    mixins:[storeComputed,Google],
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
                    formdata.append("grant_type", "password");
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

        },
        keycloak: function (){
            this.$router.push({name:'Keycloack'})
        },
        firebaseSSO: function (){
            try {
                this.loading = true
                const auth = getAuth();
                const provider = new GoogleAuthProvider();
                signInWithPopup(auth,provider).then(result => {
                    const credential = GoogleAuthProvider.credentialFromResult(result);
                    const token = credential.idToken;
                    const user = result.user;

                    queueMicrotask(() => {
                        this.updateUsers({
                            uuid: user.uid,
                            email: user.email,
                            name: user.displayName,
                            access_token:token
                        }).then(r => {
                            let data = r.data.data;
                            const formdata = new FormData();
                            formdata.append("grant_type", "password");
                            formdata.append("client_id", this.config.oauthPasswordClient.id);
                            formdata.append("client_secret", this.config.oauthPasswordClient.secret);
                            formdata.append("username", data.email);
                            formdata.append("password", data.email);
                            formdata.append("scope", "*");
                            axiosInstance('/oauth/token',POST,formdata).then(r => {
                                this.loading = false;
                                this.$store.commit('user/token',r.data)
                                this.$router.push({name:'Home'});
                            }).catch(e => {
                                this.loading = false
                            })

                        }).catch(e => {
                            this.loading = false
                        })
                    })
                }).catch(e => {
                    const errorMessage = error.message;
                    this.$store.commit('snackbar/update',{
                        show:true,
                        text: errorMessage,
                        color: 'error'
                    })

                    const credential = GoogleAuthProvider.credentialFromError(error);
                    this.loading = false
                })
            } catch (error) {
                console.error(error);
                // Handle error
            }
        }
    },
    created() {
        if(this.$route.query._e !== undefined){
            this.$store.commit('snackbar/update',{
                show: true,
                text: this.$route.query._e,
                color: 'error'
            })
        }
    }
}
</script>

