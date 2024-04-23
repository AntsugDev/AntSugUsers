import {axiosInstance,GET} from "../plugin/instance.api.js";

const LoginMixins = {
    methods:{
        getWhoAmI: function (){
            return axiosInstance('/api/v1/who_am_i',GET)
        }
    }
}
export default LoginMixins;
