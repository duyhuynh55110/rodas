import { createStore } from 'vuex'

// modules
import app from './app'

// initial store
export default createStore({
  modules: {
    app,
  }
})
