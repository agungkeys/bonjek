const CURRENT_ENV = process.env.BASE_ENV || null;
const CURRENT_API = process.env.BASE_API || null;
const CURRENT_HOST = process.env.BASE_HOST || null;
const BASE_URL = CURRENT_HOST;

export default {
  CURRENT_ENV,
  CURRENT_API,
  CURRENT_HOST,
  BASE_URL
}