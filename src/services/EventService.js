import axios from 'axios';

const apiClient = axios.create({
  baseURL: process.env.BASE_URL + 'api',
  withCredentials: false,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
});

export default {
  getProducts() {
    return apiClient.get('/read.php');
  },

  addProducts(data) {
    return apiClient.post('/create.php', data);
  },

  deleteProducts(data) {
    // Temporary usage of POST request for deleting because of free hosting limitations (no delete requests allowed on 000webhost)
    return apiClient.post('/delete.php', data);
  },

  findSKU(value) {
    return apiClient.get('/findSku.php', value);
  },
};
