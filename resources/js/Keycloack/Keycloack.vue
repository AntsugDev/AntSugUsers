<template>
<ProgressBarCommon></ProgressBarCommon>
</template>
<script>
import ProgressBarCommon from "../component/Common/ProgressBarCommon.vue";
import storeComputed from "../mixins/storeComputed.js";
import Keycloak from 'keycloak-js';
export default {
    name: "Keycloack",
    components: {ProgressBarCommon},
    mixins:[storeComputed],
    created() {
        this.$store.commit('progress/update',true)

        const keycloak = new Keycloak({
            url: "http://localhost:8080",
            realm: this.config.keycloack.realm,
            clientId: this.config.keycloack.clientId,
            redirect_uri: "http://localhost:8000/login"
        });
        keycloak.init({
            onLoad: 'login-required',
            checkLoginIframe: false,
        }).then((r) => {
            console.log('keycloak.token',keycloak.token)
            this.$store.commit('user/token', keycloak.token)
        }).catch((e) => {
         alert('error')
        })

    }
}
</script>
