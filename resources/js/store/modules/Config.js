
const state = () => ({
    appUrl: window.appConfig.appUrl,
    drawer:true,
    mini:false,
    oauthPasswordClient: {},

});
const getters = {
    appUrl: function (state) {
        return state.appUrl;
    },
    appBasePath: function (state) {
        let appUrlObject = new URL(state.appUrl);
        return appUrlObject.pathname;
    },
};
const actions = {};
const mutations = {
    changeDrawer:function (state){
        if(state.drawer)
            state.drawer = false;
        else
            state.drawer = true;

    },
    changeMini:function (state){
      if(state.mini)
          state.mini = false;
      else
          state.mini = true;
    },
    init(state,payload){
        state.oauthPasswordClient = payload.oauthPasswordClient
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}