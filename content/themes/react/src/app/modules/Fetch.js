import React from 'react';
import axios from 'axios';

export function fetchData(url) {
  

    
    return axios({
      url: url,
      timeout: 20000,
      method: 'get',
      responseType: 'json'
    })
      .then(function(response) {
        // dispatch(receiveData(response.data));
        console.log(response);
      })
      .catch(function(response){
        // dispatch(receiveError(response.data));
        // dispatch(pushState(null,'/error'));
      })
  };
