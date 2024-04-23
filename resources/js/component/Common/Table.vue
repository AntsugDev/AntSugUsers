<template>
    <v-card>
        <template v-slot:text>
            <v-text-field
                :v-model="search"
                label="Search"
                prepend-inner-icon="mdi-magnify"
                variant="outlined"
                hide-details
                single-line
            ></v-text-field>
        </template>
        <v-data-table
            loading-text="Caricamento in corso..."
            class="elevation-1"
            :headers="headers"
            :items="items"
            :search="search"
            :items-per-page="$store.getters['commons/getDefaultize']"
            :items-per-page-options="$store.getters['commons/getOptions']"
        >
            <template v-html="html" v-if="html !== undefined"></template>
        </v-data-table>
    </v-card>
</template>
<script>
export default {
    name: "Table",
    props:['headers','items','search','html']
}
</script>
