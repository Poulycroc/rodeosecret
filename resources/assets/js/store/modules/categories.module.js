import axios from "axios";

const state = () => ({
  categories: []
});

const getters = {
  categories: state => state.categories
};

const mutations = {
  SET_CATEGORIES(state, { categories }) {
    state.categories = categories;
  }
};

const actions = {
  async getCategories({ commit }) {
    console.log('getCategories')
    const { data: categories } = await axios.get("categories");
    commit("SET_CATEGORIES", { categories });
  },

  async setCategories({ commit }, payload) {
    const { data } = await axios.post("categories", payload);
    commit("SET_CATEGORIES", { categories: data.categories });
  },

  async editCategories({ commit }, { id, name }) {
    const { data } = await axios.put(`categories/${id}`, { name });
    commit("SET_CATEGORIES", { categories: data.categories });
  },

  async deleteCategories({ commit }, { id }) {
    const { data } = await axios.delete(`categories/${id}`);
    commit("SET_CATEGORIES", { categories: data.categories });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
