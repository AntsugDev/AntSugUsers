
const state = () => ({
    appUrl: window.appConfig.appUrl,
    drawer:true,
    mini:false,
    oauthPasswordClient: {},
    keycloack:{
        realm: window.appConfig.keycloack.realm,
        clientId: window.appConfig.keycloack.clientId
    }

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
    getKeycloack: function (state){
        return state.keycloack
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
