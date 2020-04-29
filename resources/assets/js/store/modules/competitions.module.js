import axios from "axios";

const state = () => ({
  competitions: [],
  landingCompetitions: [],
  currCompetition: {}
});

const getters = {
  competitions: state => state.competitions,
  landingCompetitions: state => state.landingCompetitions,
  currCompetition: state => state.currCompetition
};

const mutations = {
  SET_COMPETITIONS(state, { competitions }) {
    state.competitions = competitions;
  },
  SET_LANDING_COMPETITIONS(state, { competitions }) {
    state.landingCompetitions = competitions;
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

  async getLandingCompetitions({ commit }) {
    const { data: competitions } = await axios.get("competitions/landing");
    commit("SET_LANDING_COMPETITIONS", { competitions });
  },

  async getCompetition({ commit }, id) {
    const { data } = await axios.get(`competitions/${id}`);
    commit("SET_CURREN_COMPETITION", { competition: data.competition });
  },

  async setCompetitions({ commit }, payload) {
    const { data } = await axios({
      method: "post",
      url: "competitions",
      data: payload,
      headers: {
        "Content-Type": "application/json"
      }
    });
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async editCompetitions({ commit }, { id, payliad }) {
    const { data } = await axios({
      method: "put",
      url: `competitions/${id}`,
      data: payliad,
      headers: {
        "Content-Type": "application/json"
      }
    });
    commit("SET_COMPETITIONS", { competitions: data.competitions });
  },

  async deleteCompetitions({ commit }, { id }) {
    console.log("deleteCompetitions");
    const { data } = await axios.delete(`competitions/${id}`);
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
