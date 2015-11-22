angular.module('Hackathon', [
  'Classroom.controllers',
  'Classroom.services',
  'User.controllers',
  'User.services',
  'ngRoute'
]).config(['$routeProvider', function($routeProvider,$locationProvider) {
  $routeProvider.
    when('/',{templateUrl: "home.html", controller: "classroomsController"}).
	when("/class/:classid", {templateUrl: "class.html", controller: "classroomController"}).
	when("/class/:classid/tab_tongquan",{templateUrl:"class.html#tab_tongquan",controller:"classroomController"}).
	when("/class/:classid/tab_sinhvien",{templateUrl:"class.html#tab_sinhvien",controller:"classroomController"}).
	when("/class/:classid/tab_sinhvien",{templateUrl:"class.html#tab_gioithieu",controller:"classroomController"}).
  when("/assignment",{templateUrl:"btl.html",controller:"classroomController"})
}]);