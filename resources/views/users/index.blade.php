@extends('defaultportal')

@section('headtitle') 
    Users
@endsection

@section('content')
<div class="">
  <div>
    <div class="row">
      <div class="col-md-3">
        <!-- <div class="input-group  add-on">
          <input type="text" class="form-control search-query" ng-model="query" ng-change="search()" placeholder="Search User ID">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div> -->
      </div>
      <div class="col-md-6">
        <h4 class="text-center">Users</h4>
      </div>
      <div class="col-md-3">
        <select class="form-control pull-right" ng-model="itemsPerPage" ng-change="perPage()" ng-options="('show '+size+' per page') for size in pageSizes"></select>
      </div>
    </div>   

  	<table class="table table-striped table-hover">
      <tbody><tr>
        <th class="user_id"><a ng-click="sort_by('id')">ID<i class="fa fa-sort"></i></a></th>    
        <th class="name"><a ng-click="sort_by('first_name')">Name<i class="fa fa-sort"></i></a></th>
        <th class="email"><a ng-click="sort_by('email')">Email</a></th>
        <th class="role" title="non-sortable">Role</th>
        <th align="center"></th>
      </tr>
      </tbody>
      <tfoot>
        <tr><td colspan="9">@{{sizes}}
          <div class="text-center">
            <ul class="pagination">
              <li ng-class="{disabled: currentPage == 0}">
                <a href="javascript:;" ng-click="prevPage()">« Prev</a>
              </li>
              <li ng-repeat="n in range(pagedItems.length)" ng-class="{active: n == currentPage}" ng-click="setPage()">
                <a href="javascript:;" ng-bind="n + 1">1</a>
              </li>
              <li ng-class="{disabled: currentPage == pagedItems.length - 1}">
                <a href="javascript:;" ng-click="nextPage()">Next »</a>
              </li>
            </ul>
          </div>
        </td>
      </tr></tfoot>
      <tbody>
        <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sortingOrder:reverse" ng-click="editUser(item.id)" data-toggle="modal" data-target="#myModal">
          <td>@{{item.id}}</td>
          <td>@{{item.first_name}} @{{item.last_name}}</td>
          <td>@{{item.email}}</td>
          <td>@{{item.role}}</td>
          <td align="center">
            <button type="button" class="btn btn-info btn-primary">Edit</button>
          </td>
          <!-- <td><a href="javascript:void(0)" ng-click="deleteItem($index)">x</a></td> -->
        </tr>
  		</tbody>
  	</table>


    <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Entry</h4>
              </div>
              <div class="modal-body">
                @include('users.form')
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>

  </div>
</div>

<script src="{{ asset('/js/angular/controllers/users.js') }}"></script>
@endsection
