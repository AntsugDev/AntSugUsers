import {axiosInstance, GET, POST} from "../../plugin/instance.api.js";

const Project = {
    methods:{
        list: function (userId){
            let path = '/api/v1/users/'+userId+'/project ';
            return axiosInstance(path,GET);
        },
        create: function (userId,payload){
            let path = '/api/v1/users/'+userId+'/project ';
            return axiosInstance(path,POST,payload);
        }
    }
}
export default Project;
