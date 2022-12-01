import { createStore } from 'vuex'

// modules
import app from './modules/app'
import homeView from './modules/homeView'

// initial store
export default createStore({
  modules: {
    app,
    homeView,
  }
})
