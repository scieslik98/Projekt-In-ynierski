import axios from 'axios';
import { routes} from "../routes";

export const AUTH_REQUEST = 'AUTH_REQUEST';
export const AUTH_SUCCESS = 'AUTH_SUCCESS';
export const AUTH_FAILURE = 'AUTH_FAILURE';

export const authenticate = (username, password) => dispatch => {
  dispatch({type: AUTH_REQUEST});

 let data = new URLSearchParams();
  data.append("_username", username);
  data.append("_password", password);

  return axios
      .post('http://127.0.0.1:8000/api/auth'+location.pathname, data)
      .then(payload => {
          console.log(payload);
          dispatch({ type: AUTH_SUCCESS, payload});
      })
      .catch(err => {
          console.log('err');
         dispatch({type: AUTH_FAILURE});
      });
};
