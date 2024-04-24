<template>

    <v-row>
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
    props:['cols','nrCols'],
    data: () =>({
        colsHeader:[],
        fields:null
    }),
    methods:{
        changeOrder: function (index){
            let change = this.colsHeader[index];
            change.order = change.order === 'desc' ? 'asc' : 'desc'
            this.colsHeader[index] = change;
            this.fields = change
            this.$emit("reload")
        }
    },
    created() {
        this.colsHeader = this.cols
    }
}
</script>
<style scoped>
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
