import axios from "axios";

const state = () => ({
  competitions: []
});

const getters = {
  competitions: state => state.competitions
};

const mutations = {
  SET_COMPETITIONS(state, { competitions }) {
    state.competitions = competitions;
  }
};

const actions = {
  async getCompetitions({ commit }) {
    const { data: competitions } = await axios.get("competitions");
    commit("SET_COMPETITIONS", { competitions });
  },

  async setCompetitions({ commit }, payload) {
    const { data } = await axios.post("competitions", payload);
    // flash data.category
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async editCompetitions({ commit }, { id, name }) {
    const { data } = await axios.put(`competitions/${id}`, { name });
    // flash data.category
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async deleteCompetitions({ commit }, { id }) {
    console.log('deleteCompetitions')
    const { data } = await axios.delete(`competitions/${id}`);
    // flash data.category
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
