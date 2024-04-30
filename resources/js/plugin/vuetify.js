import {createVuetify} from "vuetify";
import 'vuetify/dist/vuetify.min.css';
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { it } from 'vuetify/locale'

const tema = {
    dark: false,
    colors:{
        primary: '#34495E',
        secondary: '#A6ACAF',
        accent: '#F1C40F',
        error: '#E74C3C',
        info: '#34495E',
        success: '#34495E',
        warning: '#F0B27A',
        google:'#16A085',
    }
}
const vuetify = createVuetify({
    components,
    directives,
    theme:{
        defaultTheme: "tema",
        themes: {
            tema,
        },
    },
    lang: {
        locales: { it },
        current: 'it',
    }
})
export default vuetify;
