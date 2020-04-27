import axios from "axios";

const state = () => ({
  competitions: [],
  currCompetition: {}
});

const getters = {
  competitions: state => state.competitions,
  currCompetition: state => state.currCompetition
};

const mutations = {
  SET_COMPETITIONS(state, { competitions }) {
    state.competitions = competitions;
  },
  SET_CURREN_COMPETITION(state, { competition }) {
    state.currCompetition = competition;
  }
};

const actions = {
  async getCompetitions({ commit }) {
    const { data: competitions } = await axios.get("competitions");
    commit("SET_COMPETITIONS", { competitions });
  },

  async getCompetition({ commit }, id) {
    const { data } = await axios.get(`competitions/${id}`);
    commit("SET_CURREN_COMPETITION", { competition: data.competition });
  },

  async setCompetitions({ commit }, payload) {
    console.log({ setCompetitions: payload });
    const { data } = await axios.post("competitions", payload);
    // flash data.category
    console.log({ data });
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async editCompetitions({ commit }, { id, name }) {
    const { data } = await axios.put(`competitions/${id}`, { name });
    // flash data.category
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async deleteCompetitions({ commit }, { id }) {
    console.log("deleteCompetitions");
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
