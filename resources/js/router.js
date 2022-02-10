import Vue from 'vue'
import Router from 'vue-router'

import FichaAuxiliar from './views/FichaAuxiliar.vue'
import Formulario from './views/Formulario.vue'
import Index from './views/Index.vue'
import Legislacao from './views/Legislacao.vue'
import Perfil from './views/Perfil.vue'

Vue.use(Router);


export default new Router({
    // mode: 'history',
    routes: [
        {
            path: '/',
            component: Index
        }, {
            path: '/formulario',
            component: Formulario,
        },
        {
            path: '/perfil',
            component: Perfil
        },
        {
            path: '/legislacao',
            component: Legislacao
        },
        {
            path: '/ficha-auxiliar',
            component: FichaAuxiliar,
        },

    ]
})