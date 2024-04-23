<template>
    <v-btn
    icon="mdi-arrow-left-circle"
    color="dark"
    size="small"
    :alt="title"
    :title="title"
    @click="$router.push({name:nameRouter})"
    >
    </v-btn>
</template>

<script>
export default {
    name: 'BackRoute',
    props:['nameRouter','title']
}
</script>
