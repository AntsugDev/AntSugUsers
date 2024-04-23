<template>
    <v-app v-if="$store.getters['progress/getShow']">
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>


</template>
<script>
import App from "../../App.vue";
import storeComputed from "../../mixins/storeComputed.js";

export default {
    name: "Index",
    components: {App},
    mixins:[storeComputed],

}
</script>
