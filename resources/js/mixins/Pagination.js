import {axiosInstance, GET} from "../plugin/instance.api.js";

const Pagination = {
    methods:{
        getCities: function (queryString){
            return axiosInstance('/api/v1/pagination?'+queryString,GET)
        }
    }
}

export default Pagination;
