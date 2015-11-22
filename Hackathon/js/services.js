angular.module('Hackathon.Classroom.services', []).
  factory('classroomAPIservice', function($http) {

    var classroomAPI = {};

    classroomAPI.getClass = function(id) {
      return $http({
        method: 'JSONP', 
        url: '10.10.213.159:80/uet2/class/get/'+id,
      });
    };
    classroomAPI.getStudent = function(id){
      return $http({
        method: 'JSONP', 
        url: '10.10.213.159:80/uet2/class/'+id+"/student",
      });
    };
    classroomAPI.getResource = function(id){
      return $http({
        method: 'JSONP', 
        url: '10.10.213.159:80/uet2/class/'+id+"/resource",
      });
    } 
    return classroomAPI;
  });