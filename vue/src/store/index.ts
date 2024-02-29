import { createStore } from 'vuex'
import userModule from '@/store/userModule'

export default createStore({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        user: userModule
    }
})
