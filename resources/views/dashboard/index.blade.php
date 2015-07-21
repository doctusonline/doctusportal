@extends('defaultportal')

@section('headtitle') 
    Dashboard
@endsection

@section('content')

        <hr>
<div class="container" ng-app="">
  <div ng-controller="initApp">
  	<div class="loading" ng-show="loading"></div>
    <div class="row">
      <div class="col-md-3">
        <!-- <div class="input-group input-group-lg add-on">
          <input type="text" class="form-control search-query" ng-model="query" ng-change="search()" placeholder="Search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div> -->
			<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			      <h3 id="myModalLabel">Modal header</h3>
			  </div>
			  <div class="modal-body">
			    <p>One fine body…</p>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button class="btn btn-primary">Save changes</button>
			  </div>
			</div>
			</div>
			</div>
      </div>
      <div class="col-md-6">
      	<h4 class="text-center">Order List</h4>
      </div>
      <div class="col-md-3">
        <select class="form-control pull-right" ng-model="itemsPerPage" ng-change="perPage()" ng-options="('show '+size+' per page') for size in pageSizes"></select>
      </div>
    </div>    
    <table class="table table-striped table-hover">
      <tbody><tr>
        <th class="id"><a ng-click="sort_by('id')">Id <i class="fa fa-sort"></i></a></th>
        <th class="sku"><a ng-click="sort_by('sku')">SKU <i class="fa fa-sort"></i></a></th>
        <th class="name"><a ng-click="sort_by('name')">Name <i class="fa fa-sort"></i></a></th>
        <th class="description" title="non-sortable">Status</th>
        <th class="repeats">Repeats</th>
        <!-- <th></th> -->
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
        <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sortingOrder:reverse">
          <td>@{{item.id}}</td>
          <td>@{{item.sku}}</td>
          <td><a href="#myModal" role="button" class="" data-toggle="modal">@{{item.name}}</a></td>
          <td>
          	<select class="form-control" ng-options="o.id as o.name for o in statusOptions track by o.name" ng-model="status" ng-change="changeStatus(status)">
          		
          	</select>
          </td>
          <td>
          	<select class="form-control" ng-options="o.id as o.name for o in repeatOptions" ng-model="repeat" ng-change="changeRepeat(repeat)">
          		
          	</select>
          </td>
          <!-- <td><a href="javascript:void(0)" ng-click="deleteItem($index)">x</a></td> -->
        </tr>
      </tbody>
    </table>
  </div>
</div>
  
<!-- JavaScript jQuery code from Bootply.com editor  -->
<script type='text/javascript' src="{{ asset('js/angular/controllers/orders.js') }}"></script>

@endsection