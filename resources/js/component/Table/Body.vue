<template>
        <v-row v-for="(v,k) in list" :key="k" >
            <v-col cols="1" v-if="isCheck && clickCheckBox !== undefined">
                <v-checkbox :value="JSON.stringify(v)" v-model="checkbox" @click="clickCheckBox"></v-checkbox>
            </v-col>
            <v-col v-for="(e,i) in keys" :key="i" :cols="nrCols">
                {{v[e]}}
            </v-col>
        </v-row>
</template>
<script>
export default {
    name: "Body",
    props:['list','nrCols','keys','isCheck','clickCheckBox'],
    data: () => ({
        checkbox: null
    })
}
</script>
<style scoped>
.v-col{
    border: 1px solid #000;
    color: #000;
}
</style>
