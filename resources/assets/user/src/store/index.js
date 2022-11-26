import { createStore } from 'vuex'

// modules
import global from './global'
import products from './products'
import categories from './categories'
import giftBoxes from './giftBoxes'

// initial store
export default createStore({
  modules: {
    global,
    products,
    categories,
    giftBoxes,
  }
})
