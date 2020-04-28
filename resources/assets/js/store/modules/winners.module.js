import axios from "axios";

const state = () => ({
  winners: [],
  currWinner: {},
  confirmedWinner: {}
});

const getters = {
  winners: state => state.winners,
  currWinner: state => state.currWinner,
  confirmedWinner: state => state.confirmedWinner
};

const mutations = {
  SET_WINNERS(state, winners) {
    state.winners = winners;
  },
  SET_GENERATED_WINNER(state, winner) {
    state.currWinner = winner;
  },
  SET_CONFIRMED_WINNER(state, winner) {
    state.confirmedWinner = winner;
  }
};

const actions = {
  async getWinners({ commit }) {
    const { data: winners } = await axios.get("winners");
    commit("SET_WINNERS", { winners });
  },

  async editWinners({ commit }, { id, name }) {
    const { data } = await axios.put(`winners/${id}`, { name });
    // flash data.category
    commit("SET_WINNERS", { winners: data.winners });
  },

  async deleteWinners({ commit }, { id }) {
    const { data } = await axios.delete(`winners/${id}`);
    commit("SET_WINNERS", { winners: data.winners });
  },

  async generateWinner({ commit }, id) {
    const { data } = await axios.get(`winners/generate/${id}`);
    commit("SET_GENERATED_WINNER", data.winner);
  },

  async saveWinner({ commit }, winner) {
    const { data } = await axios.post("winners/save", winner);
    console.log({ saveWinner: data })
    commit("SET_CONFIRMED_WINNER", data.winner);
    commit("SET_WINNERS", data.winners);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
