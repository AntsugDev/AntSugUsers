<template>
        <v-row>
            <v-col cols="2">
                <v-select
                    label="Nr.Elementi"
                    clearable
                    :items="select"
                    v-model="selectChange"
                    :loading="loading"
                    @update:modelValue="selectChangeUpdate"
                >

                </v-select>

            </v-col>
            <v-col cols="6"></v-col>
            <v-col cols="4" class="positon-cols">

                <div class="iniline">
                    <v-icon class="icon-left" size="large" v-if="(parseInt(pageNr) > 0)" @click="updatePage(pageNr,false)">mdi-arrow-left-bold-circle-outline</v-icon>
                    <span class="page">{{parseInt(pageNr)+1}}/{{nrPage}}</span>
                    <v-icon   class="icon-right" size="large" v-if="(parseInt(pageNr) < (parseInt(nrPage)-parseInt(1)))" @click="updatePage(pageNr,true)">mdi-arrow-right-bold-circle-outline</v-icon>
                </div>

            </v-col>
        </v-row>
</template>

<script>
export default {
    name: "Footer",
    props:['totElements','propsSelectChange','nrPage','page'],
    data: () =>({
        loading:false,
        select:[] ,
        selectChange:null,
        pageNr:null
    }),
    methods:{
        createdSelect: function (){
            this.select = [5,10,20,50,this.totElements]
        },
        selectChangeUpdate: function (){
            this.$emit("reload","init")
        },
        updatePage:function (index,isUp){
            if(isUp)
                this.pageNr = parseInt(index)+parseInt(1)
            else
                this.pageNr = parseInt(index)-parseInt(1)
            this.$emit("reload")

        }
    },
    created() {
        this.createdSelect()
        this.selectChange = this.propsSelectChange
        this.pageNr = parseInt(this.page)
    }
}
</script>
<style scoped>
.positon-cols{
    text-align: right;
    margin-top: 1vw;
}
.inline{
    display: inline-flex;
    float: left;
    margin-top:2vw;
}
.page{
    font-weight: 600;
    font-size: 18px;
}
.icon-left{
    margin-right: 1vw;
}
.icon-right{
    margin-left: 1vw;
}

</style>
