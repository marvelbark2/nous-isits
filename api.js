const axios = require('axios');
var apiRequest1 = axios('http://www.uiass-etudiants.ma/api_u3s/web/api/module/238').then(function(response){
    return response.data
});
var apiRequest2 = axios('http://www.uiass-etudiants.ma/api_u3s/web/api/element/200').then(function(response){
    return response.data
});
var combinedData = {"apiRequest1":{},"apiRequest2":{}};
Promise.all([apiRequest1,apiRequest2]).then(function(values){
combinedData["apiRequest1"] = values[0];
combinedData["apiRequest2"] = values[1];
return combinedData;
});
