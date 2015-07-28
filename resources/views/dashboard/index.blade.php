@extends('defaultportal')

@section('headtitle') 
    Dashboard
@endsection

@section('content')
<div class="container">
  <div ng-controller="initApp">
  	
    <div class="row">
      <div class="col-md-3">
        <div class="input-group  add-on">
          <input type="text" class="form-control search-query" ng-model="query" ng-change="search()" placeholder="Search Order ID">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
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
      <div class="col-md-3">
      	<h4 class="text-center">Order List</h4>
      </div>
      <div class="col-md-3">
        <select  class="form-control" ng-options="o.id as o.name for o in statusOptions" ng-model="selectedStatus" ng-change="filterStatus(selectedStatus)">
		</select>
      </div>
      <div class="col-md-3">
        <select class="form-control pull-right" ng-model="itemsPerPage" ng-change="perPage()" ng-options="('show '+size+' per page') for size in pageSizes"></select>
      </div>
    </div>    
    <table class="table table-striped table-hover">
      <tbody><tr>
        <th class="productid"><a ng-click="sort_by('productid')">Product ID<i class="fa fa-sort"></i></a></th>
        <th class="id"><a ng-click="sort_by('id')">Order ID<i class="fa fa-sort"></i></a></th>
        <!-- <th class="sku"><a ng-click="sort_by('sku')">SKU <i class="fa fa-sort"></i></a></th> -->
        <!-- <th class="name"><a ng-click="sort_by('name')">Product Name<i class="fa fa-sort"></i></a></th>  -->      
        <th class="product"><a ng-click="sort_by('product')">Customer Name<i class="fa fa-sort"></i></a></th>
        <th class="description" title="non-sortable">Status</th>
        <th align="center"><div align="center" ng-show="pdf">PDF</div></th>
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
        <tr ng-click="isCollapsed = !isCollapsed" ng-repeat-start="item in pagedItems[currentPage] | orderBy:sortingOrder:reverse">
          <td>@{{item.productid}}</td>
          <td>@{{item.id}}</td>
          <!-- <td>@{{item.sku}}</td> -->
          <!-- <td ng-click="isCollapsed = !isCollapsed" >@{{item.product}}</td> -->
          <!-- <td ng-click="isCollapsed = !isCollapsed" ><a href="#myModal" role="button" class="" data-toggle="modal">@{{item.name}}</a></td> -->
          <td>@{{item.name}}</td>
          <td class="capitalize">
          	@{{itemStatus(item.status)}}
          </td>
          <td align="center">
          	<div ng-if="item.status == 'prescription_approved'">
	          	<a target="_blank" href="pdf/@{{item.id}}_@{{item.name}}.pdf" class="btn btn-primary">View / Print</a>
	          	<a target="_blank" href="pdf/@{{item.id}}_@{{item.name}}.pdf" class="btn btn-primary" download="pdf/@{{item.id}}_@{{item.name}}.pdf">Download</a>
          	</div>
          </td>
          <!-- <td><a href="javascript:void(0)" ng-click="deleteItem($index)">x</a></td> -->
        </tr>
        <tr class="" collapse="isCollapsed" ng-repeat-end="">
	        <td colspan="6">
	        	<div class="row">
	        		<div class="col-md-5">
	        			<h5>Order # @{{item.id}}</h5>
	        			<p class="capitalize">Order Status: @{{itemStatus(item.status)}}</p>
	        		</div>
			        <div class="col-md-4">
			          <h5>Account Information</h5>	
			          <fieldset>
			          	<span>Customer Name: </span><label>@{{item.name}}</label>
			          </fieldset>	  
			          <fieldset>
			          	<span>Email: </span><label>@{{item.email}}</label>
			          </fieldset>	      	
			        </div>
			        <div class="col-md-3 select-status">
			        	Status: 
			          	<!-- <select ng-if="item.type == 'simple'" class="form-control" ng-options="o.id as o.name for o in statusOptions" ng-model="status" ng-change="changeStatus(item.id, status, $index)">
			          	</select> -->
                  <select ng-if="item.type == 'simple'" class="form-control" ng-model="status" ng-change="changeStatus(item.id, status, $index)">
                    <option ng-repeat="statusOption in statusOptions" value="@{{statusOption.id}}" ng-selected="item.status === statusOption.id">
                        @{{statusOption.name}}
                    </option>
                </select>
			        </div>
	        	</div>
	        	<div class="row">
			        <div class="col-md-12">
			          <h5>Items Ordered</h5>
			          <div ng-repeat="p in allItems | filter:item.id">
			          	<div class="type_@{{p.type}}">
				          	<fieldset>
				          		<div class="col-md-6"><h4><u>@{{p.product}}</u></h4>
				          			<label>SKU: </label><span>@{{p.sku}}</span>
				          		</div>
					          	<div class="col-md-2 pull-right" ng-if="p.type == 'simple' && p.status == 'prescription_approved'">Repeats: <select class="form-control" ng-options="o.id as o.name for o in repeatOptions" ng-model="repeat" ng-change="changeRepeat(repeat, item.id, p.productid)">
					          	</select></div>
				          	</fieldset>
					        <fieldset ng-if="p.options">
					        	<div class="prescription_content">
					        		<fieldset ng-repeat="option in p.options">
					        			<label><i>@{{option.label}}</i></label>
					        			<div class="option-value">- @{{option.value}} </div>
					        		</fieldset>
					        	</div>
					        </fieldset>
				        </div>
			          </div>
			        </div>
		        </div>
	        </td>
	      </tr>
      </tbody>
    </table>
  </div>
</div>
  
<!-- JavaScript jQuery code from Bootply.com editor  -->
<script type='text/javascript' src="{{ asset('js/angular/controllers/orders.js') }}"></script>

@endsection