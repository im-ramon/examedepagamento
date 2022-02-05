import Vue from 'vue'
import Router from 'vue-router'

import Index from './components/Index.vue'
import Formulario from './components/Formulario.vue'
import Perfil from './components/Perfil.vue'
import Legislacao from './components/Legislacao.vue'
import FichaAuxiliar from './components/FichaAuxiliar.vue'

Vue.use(Router);


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Index
        }, {
            path: '/formulario',
            component: Formulario
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