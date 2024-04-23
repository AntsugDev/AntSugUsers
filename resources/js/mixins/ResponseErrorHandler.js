import store from "../store/store.js";

export const  handleResponseError =   (error) =>  {
    let response = error.response;
    if( typeof response === 'object' && response.hasOwnProperty('data') && response.data !==null){
        let data = response.data
        if(data.hasOwnProperty('error_description')) {
            store.commit('snackbar/update', {
                show: true,
                text: data.error_description,
                color: 'error'
            });

        }else if(data.hasOwnProperty('errors')){
            store.commit('snackbar/update', {
                show: true,
                text:  response.data.errors ,
                color: 'error'
            });
        }else if(data.hasOwnProperty('message')){
            store.commit('snackbar/update', {
                show: true,
                text:  response.data.errors ,
                color: 'error'
            });
        }else{
            store.commit('snackbar/update', {
                show: true,
                text:  response.data.toString() ,
                color: 'error'
            });
        }
    }else{
        store.commit('snackbar/update', {
            show: true,
            text: error.toString(),
            color: 'error'
        });
    }


}
export const successResponse =  (msg) => {
    store.commit('snackbar/update', {
        show: true,
        text: msg,
        color: 'success'
    });
}



