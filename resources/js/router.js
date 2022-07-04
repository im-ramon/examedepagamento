import Vue from 'vue'
import Router from 'vue-router'

import FichaAuxiliar from './views/FichaAuxiliar.vue'
import GerarContracheque from './views/GerarContracheque.vue'
import GerenciarContracheque from './views/GerenciarContracheque.vue'
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
            path: '/gerar-contracheque',
            component: GerarContracheque,
        }, {
            path: '/gerenciar-contracheque',
            component: GerenciarContracheque,
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