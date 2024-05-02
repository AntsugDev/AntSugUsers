import store from "../store/store.js";

export const Menu = () =>   {
    let role = null;
    let google = store.getters['user/getGoogle']
    if(!google)
        return [

            {
                text:'Pagination',
                icon: 'mdi-book-open-page-variant',
                routeName: 'Pagination',
                children:[]
            },


        ];
    else
        return [

            {
                text:'Project',
                icon: 'mdi-pencil',
                routeName: null,
                children:[
                    {
                        text:'Project List',
                        icon: 'mdi-format-list-bulleted-square',
                        routeName: 'Project',
                        children:[]
                    },
                    {
                        text:'Task List',
                        icon: 'mdi-file-tree',
                        routeName: 'Pagination',
                        children:[]
                    },
                ]
            },


        ];
}
