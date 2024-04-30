<template>
    <v-navigation-drawer v-model="config.drawer" color="primary" :clipped="true" :rail="config.mini" permanent floating >
        <v-divider></v-divider>
        <template v-for="item in drawerItems">
            <v-list density="compact"
                    :opened="opened"
                    @update:opened="newOpened => opened = newOpened.slice(-1)"
                    v-if="item.children.length > 0"
                    nav
            >
                <v-list-group v-model="item.active" >
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            :key="item.text"
                            v-bind="props"
                            :title="item.text"
                            :prepend-icon="item.icon"
                        ></v-list-item>
                    </template>
                    <v-list-item
                        nav
                        link
                        :alt="subMenu.text"
                        v-for="subMenu in item.children"
                        :key="subMenu"
                        :title="subMenu.text"
                        :prepend-icon="subMenu.icon"
                        :to="{name:subMenu.routeName}"
                    ></v-list-item>


                </v-list-group>
            </v-list>

            <v-list density="compact" v-else nav>
                <v-list-item
                    :alt="item.text"
                    :title="item.text"
                    :prepend-icon="item.icon"
                    :to="{name:item.routeName}"
                ></v-list-item>
            </v-list>
        </template>
        <template v-slot:append>
            <div class="pa-2 mb-5">
                <v-btn  to="/api/documentation" icon="mdi-api" target="_blank" alt="Documentation" title="Documentation"></v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script>
import storeComputed from "../../mixins/storeComputed.js";
import {Menu} from "../../plugin/menu.list.js";

export default {
    name: "NavigationDrawerCommon",
    mixins:[storeComputed],
    data: () => ({
        drawerItems: [],
        opened:[],
    }),
    created() {
        this.drawerItems = Menu()
    }
}
</script>

