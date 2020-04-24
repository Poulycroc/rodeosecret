import axios from "axios";
import Cookies from "js-cookie";

const state = {
  user: null,
  token: Cookies.get("token")
};

const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null
};

const mutations = {
  SAVE_TOKEN(state, { token, remember }) {
    state.token = token;
    Cookies.set("token", token, { expires: remember ? 365 : null });
  },

  FETCH_USER_SUCCESS(state, { user }) {
    state.user = user;
  },

  FETCH_USER_FAILURE(state) {
    state.token = null;
    Cookies.remove("token");
  },

  LOGOUT(state) {
    state.user = null;
    state.token = null;

    Cookies.remove("token");
  },

  UPDATE_USER(state, { user }) {
    state.user = user;
  }
};

const actions = {
  saveToken({ commit }, payload) {
    commit("SAVE_TOKEN", payload);
  },

  async fetchUser({ commit }) {
    try {
      const { data } = await axios.get("user");

      commit("FETCH_USER_SUCCESS", { user: data });
    } catch (e) {
      commit("FETCH_USER_FAILURE");
    }
  },

  updateUser({ commit }, payload) {
    commit("UPDATE_USER", payload);
  },

  async logout({ commit }) {
    try {
      await axios.post("logout");
    } catch (e) {}

    commit("LOGOUT");
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
