import axios from "axios";

const state = () => ({
  participants: []
});

const getters = {
  participants: state => state.participants
};

const mutations = {
  SET_PARTICIPANTS(state, { participants }) {
    state.participants = participants;
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
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
