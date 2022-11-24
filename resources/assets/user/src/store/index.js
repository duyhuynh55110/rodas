import { createStore } from 'vuex'
import products from './products'
import categories from './categories'
import global from './global'

// initial store
export default createStore({
  modules: {
    products,
    categories,
    global,
  }
})
