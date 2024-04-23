import {axiosInstance,GET} from "../plugin/instance.api.js";
import store from "../store/store.js";

const ConfigMixins = {
    methods:{
        configurazioni: function (){
            axiosInstance('/api/v1/root', GET).then(r => {
                let data = r.data
                store.commit('config/init', data)
            })
        }
    }
}
export default ConfigMixins;
