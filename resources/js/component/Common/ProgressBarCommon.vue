<template>
<v-progress-linear indeterminate color="coldirettiGreen" v-if="$store.getters['progress/getShow']"></v-progress-linear>
</template>
<script>
export default {
    name: "ProgressBarCommon"
}
</script>
