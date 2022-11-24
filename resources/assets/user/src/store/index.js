import { createStore } from 'vuex'
import products from './products'

// initial store
export default createStore({
  modules: {
    products
  }
})
