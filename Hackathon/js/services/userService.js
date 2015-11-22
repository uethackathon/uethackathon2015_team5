angular.module('User.services', []).
  factory('userAPIservice', function($http) {

    var classroomAPI = {};

    classroomAPI.getClassInfo = function(id) {
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class/get/'+id,
      });
    };
    classroomAPI.getStudent = function(id){
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class_room/get'+id,
      });
    };
    classroomAPI.getResource = function(id){
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class/'+id+"/resource",
      });
    } 
    return classroomAPI;
  });