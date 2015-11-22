angular.module('Classroom.controllers', []).
controller('classroomController', function($scope,$route,$routeParams,classroomAPIservice) {

	$scope.params = $routeParams;
	$scope.$route = $route;
	$scope.classInfo = {};
	$scope.classroomName = "Project 3";
	$scope.classId = 12;
	$scope.classCode = "IT123";
	// $scope.studentsList = [];
	// $scope.resourceList = [];
	classroomAPIservice.getClassInfo($routeParams.classid).success(function(response){
		$scope.classInfo = response;
		console.log(response[0]);
		$scope.classId = response[0].id;
		$scope.classroomName = response[0].name;
	});
	// classroomAPIservice.getStudent($scope.classId).success(function(response){
	// 	$scope.studentsList = response;
	// });
	// classroomAPIservice.getResource($scope.classId).success(function(response){
	// 	$scope.resourceList = response;
	// });
}).controller('classroomsController',function($scope,classroomAPIservice){
    $scope.classList=[]; 
	classroomAPIservice.getAllClasses().success(function(response){
		console.log(response);
		$scope.classList = response;
	})
});