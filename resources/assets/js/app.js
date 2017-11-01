
require('./bootstrap');

import 'angular';

var LaravelCRUD = angular.module('LaravelCRUD',[]);

LaravelCRUD.controller('TaskController', ['$scope', '$http', function($scope, $http) {

    $scope.tasks = [];

    // List tasks
    $scope.loadTasks = function () {
        $http.get('/tasks')
            .then(function success(e) {
                $scope.tasks = e.data.tasks;
            });
    };
    $scope.loadTasks();

    $scope.errors = [];

    $scope.task = {
        name: '',
        description: ''
    };

    // Open Create-Task modal
    $scope.initAdd = function () {
        $scope.resetForm();
        $('#add_new_task').modal('show');
    };

    // Add new task
    $scope.addTask = function () {
        $http.post('/tasks', {
            name: $scope.task.name,
            description: $scope.task.description
        }).then(function success(response) {
            $scope.resetForm();
            $scope.tasks.push(response.data.task);
            $('#add_new_task').modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.edit_task = {};

    // Open Edit-Task modal
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_task = $scope.tasks[index];
        $('#edit_task').modal('show');
    };

    // Update task
    $scope.updateTask = function () {
        $http.patch('/tasks/' + $scope.edit_task.id, {
            name: $scope.edit_task.name,
            description: $scope.edit_task.description
        }).then(function success(response) {
            $scope.errors = [];
            $('#edit_task').modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    // Delete task
    $scope.deleteTask = function (index) {
        let confirm = window.confirm('Do you really want to delete this task?');

        if (confirm) {
            $http.delete('/tasks/' + $scope.tasks[index].id)
                .then(function success(response) {
                    $scope.tasks.splice(index, 1);
                });
        }
    };

    // Add errors
    $scope.recordErrors = function (error) {
        $scope.errors = [];

        if (error.data.errors.name) {
            $scope.errors.push(error.data.errors.name[0]);
        }

        if (error.data.errors.description) {
            $scope.errors.push(error.data.errors.description[0]);
        }
    };

    // Reset form
    $scope.resetForm = function () {
        $scope.task.name = '';
        $scope.task.description = '';
        $scope.errors = [];
    };
}]);
