import axios from "axios";

const state = () => ({
  participants: [],
  signedParticipants: [],
  winnersParticipants: []
});

const getters = {
  participants: state => state.participants,
  signedParticipants: state => state.signedParticipants,
  winnersParticipants: state => state.winnersParticipants
};

const mutations = {
  SET_PARTICIPANTS(state, { participants }) {
    state.participants = participants;
  },
  SET_SIGNED_PARTICIPANTS(state, participants) {
    state.signedParticipants = participants;
  },
  SET_WINNERS_PARTICIPANTS(state, participants) {
    state.winnersParticipants = participants;
  }
};

const actions = {
  async getParticipants({ commit }) {
    const { data: participants } = await axios.get("participants");
    commit("SET_PARTICIPANTS", { participants });
  },

  async setParticipants({ commit }, payload) {
    const test = {
      competition_id: payload.competition.id,
      ...payload.participant
    }
    console.log({ test })
    const { data } = await axios.post("participants", test);
    // flash data.category
    commit("SET_PARTICIPANTS", { participants: data.participants });
  },

  async editParticipants({ commit }, { id, name }) {
    const { data } = await axios.put(`participants/${id}`, { name });
    // flash data.category
    commit("SET_PARTICIPANTS", { participants: data.participants });
  },

  async deleteParticipants({ commit }, { id }) {
    console.log("deleteparticipants");
    const { data } = await axios.delete(`participants/${id}`);
    // flash data.category
    commit("SET_PARTICIPANTS", { participants: data.participants });
  },

  /**
   * @param {String or Number} id - competitionID 
   */
  async getSignedParaticipants({ commit }, id) {
    const { data } = await axios.get(`participants/signed/${id}`)
    commit('SET_SIGNED_PARTICIPANTS', data)
  },

  /**
   * @param {String or Number} id - competitionID 
   */
  async getWinnersParticipants({ commit }, id) {
    const { data } = await axios.get(`participants/winners/${id}`)
    commit('SET_WINNERS_PARTICIPANTS', data)
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
