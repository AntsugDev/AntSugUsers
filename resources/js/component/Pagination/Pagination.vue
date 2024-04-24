<template>
    <v-app v-if="!$store.getters['progress/getShow']">
        <v-main>
            <router-view ></router-view>
            <v-row><v-col cols="12"></v-col></v-row>
            <v-card>
                <v-card-title>
                    <TitlePage title="Test per table pagination"></TitlePage>
                </v-card-title>
            </v-card>
            <v-card-text>
                <v-progress-linear indeterminate color="coldirettiGreen" v-if="loading"></v-progress-linear>
                <template v-else>
                    <v-container>
                        <Headers @reload="reload" ref="tableHeader" :cols="headers" :nr-cols="nrCols"></Headers>
                        <Body :list="item" :nr-cols="nrCols" :keys="keys"></Body>
                        <Footer ref="tableFooter" @reload="reload" :tot-elements="totElements" :props-select-change="size" :nr-page="pageTotal" :page="page"></Footer>
                    </v-container>
                </template>
            </v-card-text>
        </v-main>
    </v-app>
</template>
<script>
import storeComputed from "../../mixins/storeComputed.js";
import TitlePage from "../Common/TitlePage.vue";
import Pagination from "../../mixins/Pagination.js";
import Headers from "../Table/Headers.vue";
import Body from "../Table/Body.vue";
import Footer from "../Table/Footer.vue";
import ProgressBarCommon from "../Common/ProgressBarCommon.vue";

export default {
    name: "Pagination",
    components: {ProgressBarCommon, Footer, Body, Headers, TitlePage},
    mixins:[storeComputed,Pagination],
    data:() => ({
        item:[],
        totElements: 0,
        pageTotal:0,
        size:5,
        page:0,
        table:{
            order:'desc',
            sortBy:null,
        },
        loading: false,
        headers:[
            {name:'Nome',fields: 'denominazione',order: 'desc'},
            {name:'Regione',fields: 'regione',order: 'desc'},
            {name:'Provincia',fields: 'provinicia',order: 'desc'},
            {name:'Codice Catastale',fields: 'codice_catastale',order: 'asc'},
        ],
        nrCols:null,
        keys:[]
    }),

    methods:{
        list: function (queryString){
            this.loading = true
            this.getCities(queryString).then(r => {
                let data = r.data;
                let contents = data.contents
                let pagination = data.pagination
                this.item = contents;
                this.size = pagination.size
                this.pageTotal = pagination.totPage
                this.page = pagination.page
                this.table.order = pagination.order
                this.table.sortBy = pagination.sortBy
                this.totElements = pagination.totElement;
                this.loading = false
            }).catch(e => {
                this.loading = false
            })
        },
        reload: function (init){
            if(init === undefined){
                let header       = this.$refs.tableHeader.fields;
                if(header !== null) {
                    this.table.order = header.order
                    this.table.sortBy = header.fields
                }
                let footerSelect = this.$refs.tableFooter.selectChange
                if(footerSelect !== null) {
                    this.size = footerSelect
                }

                let footerPage = this.$refs.tableFooter.pageNr
                if(footerPage !== null)
                    this.page = footerPage
            }else{
                let footerSelect = this.$refs.tableFooter.selectChange
                this.size = footerSelect
                this.page =  0;
                this.table.order = 'desc'
                this.table.sortBy = null
            }

            this.list(this.getQueryString())
        },
        getQueryString: function (){
            let queryString = "size="+this.size+"&page="+this.page
            if(this.table.order !== "desc" && this.table.sortBy !== null)
                queryString +="&order="+this.table.order+"&sortBy="+this.table.sortBy
            return queryString;
        },
        createKeys: function (){
            if(this.headers.length > 0){
                for(let i = 0 ; i <this.headers.length; i++ ){
                    let row = this.headers[i]
                    let keys = row.fields
                    this.keys.push(keys)

                }
            }
        }
    },
    created() {
        this.nrCols = Math.round(this.cols/12)
        this.list(this.getQueryString());
        this.createKeys();
    }
}
</script>
