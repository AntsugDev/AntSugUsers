<template>

    <v-app v-if="!$store.getters['progress/getShow']">
        <v-main>
            <router-view @reload="getList" ></router-view>
            <v-row><v-col cols="12"></v-col></v-row>
            <v-card elevation="3">
                <v-card-title>
                    <TitlePage title="Project" :action="create" icon_btn="mdi-plus" alt="Aggiungi progetto"></TitlePage>
                </v-card-title>
                <v-card-text>
                    <v-data-table
                        loading-text="Caricamento in corso..."
                        class="elevation-1"
                        :headers="headers"
                        :items="items"
                        :sort-by="[{ key: 'updated_at', order: 'asc' }]"
                    >
                        <template v-slot:[`item.action`]="{ item }">
                            <v-btn
                                density="compact"
                                icon="mdi-delete-circle-outline"
                                color="error" alt="Dissocia" title="Dissocia"
                                @click=""></v-btn>
                        </template>

                    </v-data-table>
                </v-card-text>
                <v-card-actions>

                </v-card-actions>
            </v-card>
        </v-main>
    </v-app>

</template>
<script>
import TitlePage from "../../Common/TitlePage.vue";
import storeComputed from "../../../mixins/storeComputed.js";
import Project from "../../../mixins/Task/Project.js";
export default {
    name: "Project",
    components: {TitlePage},
    mixins:[storeComputed, Project],
    data: () => ({
        loading: false,
        searching: false,
        headers: [
            {title:'Nome',key: 'name'},
            {title:'Data',key: 'updated_at'},
            {title:'Action',key: 'action'},
        ],
        items: [],
    }),
    methods:{
        getList: function (){
            this.loading = true
            let userId = this.$store.getters['user/getUserId']
            this.list(userId).then(r => {
                let data = r.data.data
                this.items = data
                this.loading = false
            }).catch(e => {
                this.loading = false
            })
        },
        create: function (){
            this.$router.push({name:'CreateProject'})
        }
    },
    created() {
        this.getList();
    }
}
</script>
