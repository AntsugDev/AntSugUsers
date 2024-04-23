const state = () => ({
    cuaaFound: [],
    fileName: '',
    options_datatable:[
        {value: 5, title: '5'},
        {value: 10, title: '10'},
        {value: 20, title: '20'},
        {value: -1, title: '$vuetify.dataFooter.itemsPerPageAll'},
    ],
    defaultSize:5
});
const getters = {
    cuaaFound: function (state) {
        return state.cuaaFound;
    },
    fileName: function (state) {
        return state.fileName;
    },
    getOptions:function (state){
        return state.options_datatable
    },
    getDefaultize:function (state){
        return state.defaultSize
    }
};
const actions = {};
const mutations = {
    setCuaa: function (state, cuaa) {
        state.cuaaFound = cuaa;
    },
    setFileName: function (state, fileName) {
        state.fileName = fileName;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
