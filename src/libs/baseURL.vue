

var instance = axios.create({
  baseURL: 'http://10.3.135.228:777/php/',
  timeout: 1000,
  headers: {'Content-Type': 'application/x-www-form-urlencoded'}
});

export default instance;