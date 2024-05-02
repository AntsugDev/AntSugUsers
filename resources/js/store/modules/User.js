import moment from "moment";

const state = () => ({
    data: {
        jwt: {
            expired: null,
            access_token: null,
        },
        user:{
            isAuthenticated: false,
            firstName:null,
            lastName:null,
            email:null,
            google:false
        }
    }
});

const getters = {
    getJwt: function (state){
        return state.data.jwt
    },
    getUser:function (state){
        return state.data.user
    },
    getIsAuthenticated:function (state){
        return state.data.user.isAuthenticated
    },
    getGoogle: function (state){
        return state.data.user.google
    }
};
const actions = {};
const mutations = {
    create(state, attributes) {
        state.data = attributes.data;
    },
    update(state,payload){
        state.data.user = payload
    },
    token(state,attributes){
        let $now                  = moment()
        state.data.jwt.access_token        = typeof attributes === 'object' && attributes.hasOwnProperty('access_token') ? attributes.access_token : attributes;
        state.data.jwt.expired             = $now.add(1,'h');
        state.data.isAuthenticated         = true;
    },
    deleteUser(state){
        let obj = {
            jwt: {
                expired: null,
                access_token: null,
            },

        }
        state.data = obj;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
