import {red} from "vuetify/util/colors";

const state = () => ({
    show: false,
});

const getters = {
    getShow:function (state){
        return state.show;
    }
};
const actions = {};
const mutations = {
    update(state,futureState) {
        state.show = futureState
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
