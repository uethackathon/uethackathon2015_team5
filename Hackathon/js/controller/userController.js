angular.module('User.controllers', []).
controller('userController', function($scope,userAPIservice) {

	$scope.userInfo = [];
	$scope.username = "Project 3";
	$scope.userId = 12;
	$scope.userCode = "123";
	$scope.classLists = [];
	$scope.resourceList = [];
	userAPIservice.getUserClass($scope.userId).success(function(response){
		$scope.classLists = response;
	});
	userAPIservice.getInfo($scope.classId).success(function(response){
		$scope.studentsList = response;
	});
	userAPIservice.getResource($scope.classId).success(function(response){
		$scope.resourceList = response;
	});
});