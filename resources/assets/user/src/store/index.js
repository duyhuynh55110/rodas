import { createStore } from 'vuex'

// modules
import global from './global'
import products from './products'

// initial store
export default createStore({
  modules: {
    global,
    products,
  }
})
