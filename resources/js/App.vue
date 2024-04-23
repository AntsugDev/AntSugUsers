<template>
    <router-view></router-view>
</template>
<script>
import ConfigMixins from "./mixins/Config.js";

export default {
    name: "App",
    mixins:[ConfigMixins],
    created() {
        this.configurazioni();
    }
}
</script>
