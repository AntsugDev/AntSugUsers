import {axiosInstance, POST} from "../plugin/instance.api.js";

const Google = {
    methods:{
        updateUsers: function (payload){
            return axiosInstance('/api/v1/google',POST,payload)
        }
    }
}

export default Google;
