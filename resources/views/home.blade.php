@extends('layouts.app')

@section('content')
<div class="container" ng-controller="TaskController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-xs pull-right" ng-click="initAdd()">Add</button>
                    Task
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped" ng-if="tasks.length > 0">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        <tr ng-repeat="(index, task) in tasks">
                            <td>
                                @{{ index + 1 }}
                            </td>
                            <td>@{{ task.name }}</td>
                            <td>@{{ task.description }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Edit</button>
                                <button class="btn btn-danger btn-xs" ng-click="deleteTask(index)" >Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add_new_task">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Create Task</h4>
                </div><!-- /modal-header -->

                <div class="modal-body">
                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               ng-model="task.name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  ng-model="task.description"></textarea>
                    </div>
                </div><!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" ng-click="addTask()" class="btn btn-primary">Submit</button>
                </div><!-- /modal-footer -->
            </div><!-- /modal-content -->
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="edit_task">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title">Update Task</h4>
                </div><!-- /modal-header -->

                <div class="modal-body">
                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               ng-model="edit_task.name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  ng-model="edit_task.description"></textarea>
                    </div>
                </div><!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" ng-click="updateTask()" class="btn btn-primary">Submit</button>
                </div><!-- /modal-footer -->
            </div><!-- /modal-content -->
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->
</div>
@endsection
