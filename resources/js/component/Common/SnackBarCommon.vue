<template>
    <v-snackbar
        v-model="snackbar.show"
        location="top"
        :color="snackbar.color"
        :timeout="8000"
        multi-line
        dense
    >
        {{ snackbar.text }}
        <template v-slot:action="{ attrs }">
            <v-btn :color="snackbar.color" fab x-small dark v-bind="attrs"
                   @click="$store.commit('snackbar/update', { show: false })" class="elevation-6">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </template>
    </v-snackbar>
</template>
<script>
import storeComputed from "../../mixins/storeComputed.js";
export default {
    name:'SnackBarCommon',
    mixins:[storeComputed]
}

</script>
