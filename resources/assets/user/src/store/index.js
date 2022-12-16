import { createStore } from 'vuex'

// modules
import app from './app'
import wishlistView from './views/wishlistView'

// categories
import categoryDetailView from './views/categories/categoryDetailView'

// initial store
export default createStore({
  modules: {
    app,
    categoryDetailView,
    wishlistView,
  }
})
