<template>
    <v-toolbar density="compact" flat color="primary" dark>
        <v-icon class="ml-2" v-if="icon !== undefined">
            {{icon}}
        </v-icon>
        <v-toolbar-title>{{title}} </v-toolbar-title>
        <v-spacer></v-spacer>
            <v-btn
                fab
                :icon="icon_btn"
                @click="action"
                v-if="icon_btn !== undefined && btn === undefined"
                :alt="alt"
                :title="alt"
            >
            </v-btn>
            <v-btn
                v-else-if="icon_btn === undefined && btn !== undefined"
                depressed
                @click="action"
                :text="btn"
                :alt="alt"
                :title="alt"
            >
            </v-btn>
            <v-btn
                v-else
                depressed
                :icon="icon_btn"
                @click="action"
                :text="btn"
                :alt="alt"
                :title="alt"
            >
            </v-btn>
    </v-toolbar>
</template>
<script>
export default {
    name: "TitlePage",
    props:['icon','title','btn','action','icon_btn',"alt"]
}
</script>
