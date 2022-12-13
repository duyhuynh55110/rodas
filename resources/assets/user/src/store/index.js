import { createStore } from 'vuex'

// modules
import app from './app'
import homeView from './views/homeView'
import wishlistView from './views/wishlistView'

// categories
import categoryIndexView from './views/categories/categoryIndexView'
import categoryDetailView from './views/categories/categoryDetailView'

// initial store
export default createStore({
  modules: {
    app,
    homeView,
    categoryIndexView,
    categoryDetailView,
    wishlistView,
  }
})
