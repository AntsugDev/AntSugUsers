import {axiosInstance, GET} from "../../plugin/instance.api.js";

const Project = {
    methods:{
        list: function (userId){
            let path = '/api/v1/users/'+userId+'/project ';
            return axiosInstance(path,GET);
        }
    }
}
export default Project;
