import axios from "axios";
import store from "../store/store.js";
import {handleResponseError, successResponse} from "../mixins/ResponseErrorHandler.js";
export const axiosInstance =($url, $method,  $body,  $includes) => {
    try{

        let $token = null;
        $includes = $includes === undefined ? null : $includes;
        $body = $body === undefined ? null : $body;
        if($url.indexOf('oauth') === -1 ) {
            let    $store = store.getters['user/getJwt']
            $token        = $store.access_token
        }

        let $apiUrl = window.appConfig.appUrl+$url;

        if($includes !== null) {
            if ($includes !== 'object' && Object.keys($includes).length > 0)
                $apiUrl += "?includes=" + $includes.join(',');
            else if(typeof $includes === 'string')
                $apiUrl += "?includes=" + $includes;
        }

        let $headers ={};
        if($url.indexOf('oauth') !== -1){
            $headers['Content-Type'] = 'multipart/form-data'
        }else
            $headers.Accept =  'application/json'

        if($token !== null)
            $headers.Authorization = 'Bearer ' + $token


        return new Promise((resolve,reject) => {
            if($body === null){
                axios.request({
                    url: $apiUrl,
                    method: $method,
                    headers: $headers,
                    timeout: 180000,
                }).then(r => {
                    let data = r.data;
                    if(data.hasOwnProperty('data') && data.data.hasOwnProperty('esito')){
                        successResponse(data.data.esito)
                    }
                    resolve(r)
                }).catch(e => {
                    store.commit('progress/update',false)
                    handleResponseError(e)
                    reject(e)
                })

            }else{
                axios.request({
                    url: $apiUrl,
                    method: $method,
                    headers: $headers,
                    data:($body instanceof FormData ? $body : {data:$body}),
                    timeout: 180000,
                }).then(r => {
                    let data = r.data;
                    if(data.hasOwnProperty('data') && data.data.hasOwnProperty('esito')){
                        successResponse(data.data.esito)
                    }
                    resolve(r)
                }).catch(e => {
                    store.commit('progress/update',false)
                    handleResponseError(e)
                    reject(e)
                })

            }


        })


    }catch (e){
        alert('Promise error')
    }


}


export const POST = 'POST';
export const GET = 'GET';
export const DELETE = 'DELETE';
export const PUT = 'PUT';
export const PATCH = 'PATCH';





