
const state = () => ({
    appUrl: window.appConfig.appUrl,
    drawer:true,
    mini:false,
    oauthPasswordClient: {},
    rhsso: {},
    uuid:null,
    keyReCaptha: window.appConfig.keyReCaptha,
    pKeyReCaptha: window.appConfig.pKeyReCaptha,

});
const getters = {
    appUrl: function (state) {
        return state.appUrl;
    },
    appBasePath: function (state) {
        let appUrlObject = new URL(state.appUrl);
        return appUrlObject.pathname;
    },
    getConfigRhsso: function (state){
        return state.rhsso
    },
    getUuid(state){
        return state.uuid
    },
    getKeyCaptcha(state){
        return state.keyReCaptha
    },
    getPKeyCaptcha(state){
        return state.pKeyReCaptha
    }
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
        state.rhsso               =  payload.rhsso;
    },
    setUuid: function (state,uuid){
        state.uuid = uuid;
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
