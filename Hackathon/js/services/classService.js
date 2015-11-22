angular.module('Classroom.services', []).
  factory('classroomAPIservice', function($http) {

    var classroomAPI = {};

    classroomAPI.getClassInfo = function(id) {
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class_room/get/'+id,
      });
    };
    classroomAPI.getStudent = function(id){
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class_room/get'+id,
      });
    };
    // classroomAPI.getResource = function(id){
    //   return $http({
    //     method: 'JSONP', 
    //     url: '10.10.213.159:80/uet2/class_room/'+id+"/resource",
    //   });
    // } 
    classroomAPI.getAllClasses = function(){
      return $http({
        method: 'GET', 
        url: 'http://10.10.213.159:80/uet2/class_room/'
      });
    } 
    return classroomAPI;
  });