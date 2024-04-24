<template>
    <v-container>
        <v-row v-for="(v,k) in list" :key="k" >
            <v-col v-for="(e,i) in v" :key="i" :cols="nrCols">
                {{e}}
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    name: "Body",
    props:['list','nrCols'],
    created() {
    }
}
</script>
<style scoped>
.v-col{
    border: 1px solid #000;
    color: #000;
}
</style>
