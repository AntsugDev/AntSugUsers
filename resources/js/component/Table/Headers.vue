<template>

    <template v-if="search" class="filters">


        <v-row justify="end" align-content="end">

            <v-btn
                v-if="download"
                fab
                size="large"
                icon="mdi-download"
                @click="downloadList"
                alt="Download list in csv"
                title="Download list in csv"
                color="success"
                :loading="loadingDownlaod"
            ></v-btn>

            <v-btn
                fab
                size="large"
                icon="mdi-filter"
                @click="openSearch"
                alt="Filtra risultato"
                title="Filtra risultato"
                color="success"
            ></v-btn>
        </v-row>
        <v-row >
            <br />
            <v-text-field
                v-if="open"
                class="text"
                label="Cerca"
                v-model="searchModel"
                @input="changeSearching"
                clearable
                @click:clear="clearing"
            ></v-text-field>
        </v-row>
    </template>

    <v-row>
        <v-col cols="1" v-if="isCheck && clickCheckBox !== undefined"></v-col>
        <v-col v-for="(v,k) in cols" :key="k" :cols="nrCols">
            <div class="inline">

                <p>{{v.name}}</p>
                <v-icon @click="changeOrder(k)">{{v.order === 'desc' ? 'mdi-arrow-down-thin' : 'mdi-arrow-up-thin'}}</v-icon>
            </div>
        </v-col>
    </v-row>


</template>
<script>
export default {
    name: "Headers",
    props:['cols','nrCols','isCheck','clickCheckBox','search','download','loadingDownlaod'],
    data: () =>({
        colsHeader:[],
        fields:null,
        searchModel:null,
        open:false
    }),
    methods:{
        changeOrder: function (index){
            let change = this.colsHeader[index];
            change.order = change.order === 'desc' ? 'asc' : 'desc'
            this.colsHeader[index] = change;
            this.fields = change
            this.$emit("reload")
        },
        changeSearching: function (){
            this.$emit("searching")
        },
        clearing: function (){
            this.searchModel = null;
            this.$emit("searching")
        },
        openSearch:function (){
            this.open = !this.open
        },
        downloadList:function (){
            this.$emit("downloading")
        }
    },
    created() {
        this.colsHeader = this.cols
    }
}
/*
todo possibilità di aggiungere un check per selezionare la riga
todo possibilità di aggiungere una barra di search
 */
</script>
<style scoped>

.text{
    margin-top: 1vw;
    padding-top: 1vw;
    width: 80%;
}

.v-col{
    border: 1px solid #000;
    background-color: #34495E;
    color: #fff;
}
p{
    font-weight: 800;
}
.inline{
    display: inline-flex;
    float: left;
}

</style>
