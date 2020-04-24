import Vue from "vue";
import Vuex from "vuex";

// --------------------------------
// init store
// --------------------------------
let stores = {};
let storeModules = {};

const modules = require.context("./modules", false, /\.module\.js$/);
const moduleName = string => {
  return string.replace(".module.js", "").replace("./", "");
};

modules.keys().forEach(key => (stores[key] = modules(key)));

for (let store in stores) {
  for (let j in stores[store]) {
    storeModules[moduleName(store)] = stores[store][j];
  }
}

Vue.use(Vuex);

// --------------------------------
// managing globals errors
// --------------------------------
const state = {
  error: {}
};

const getters = {
  error: state => state.error
};

const mutations = {
  SET_ERROR(state, error) {
    state.error = error;
  },
  RESET_ERROR(state, resetError) {
    state.error = resetError;
  }
};

const actions = {
  //Set thes errors in state
  throwError({ commit }, error) {
    commit("SET_ERROR", error);
  },
  //Empty the state error
  resetError({ commit }) {
    const resetError = {};
    commit("RESET_ERROR", resetError);
  }
};

// --------------------------------
// Set globals and modules actions
// --------------------------------
const store = new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
  modules: {
    ...storeModules
  }
});

export default store;
