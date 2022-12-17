import { createStore } from 'vuex'

// modules
import app from './app'
import wishlistView from './views/wishlistView'

// initial store
export default createStore({
  modules: {
    app,
    wishlistView,
  }
})
