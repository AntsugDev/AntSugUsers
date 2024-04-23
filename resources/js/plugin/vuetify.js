import {createVuetify} from "vuetify";
import 'vuetify/dist/vuetify.min.css';
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { it } from 'vuetify/locale'

const tema = {
    dark: false,
    colors:{
        primary: '#82E0AA',
        secondary: '#A6ACAF',
        accent: '#F1C40F',
        error: '#E74C3C',
        info: '#2196F3',
        success: '#82E0AA',
        warning: '#F0B27A',
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
