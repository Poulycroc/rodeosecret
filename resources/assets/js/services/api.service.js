import axios from "axios";

/**
 * Fetching setting for axios
 * @param {String} baseURL
 * @param {Object} options
 */
const init = (baseURL, options = {}) => {
  axios.defaults.baseURL = baseURL;

  Object.keys(options).forEach(option => {
    axios.options[option] = options[option];
  });
};

const removeHeaders = () => {
  axios.defaults.headers.common = {};
};

const crud = {
  get(resource) {
    return axios.get(resource).then(res => {
      return res.data;
    });
  },

  post(resource, data) {
    return axios.post(resource, data);
  },

  put(resource, data) {
    return axios.put(resource, data);
  },

  patch(resource, data) {
    return axios.patch(resource, data);
  },

  delete(resource) {
    return axios.delete(resource);
  }
};

const customRequest = request => {
  return axios(request);
};

export default {
  init,
  ...crud,
  removeHeaders,
  customRequest
};