@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> PRODUCTS
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Product</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Description</th>
                <th>Specification</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $row)
            <tr>
                <td>{{ $row->description }}</td>               
                <td>{{ $row->specification }}</td>
                <td>{{ $row->quanty }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->buyingPrice }}</td>
                <td>{{ $row->sellingPrice }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->id }}"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            {{-- delete supervisors Modal--}}

                <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        COMFIRM DELETE ACTION

                            <form class="form" action="/deleteWarehouse" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" class="btn btn-primary">Comfirm</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>

            {{-- edit supervisors Modal--}}

                <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Fuel Request</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateWarehouse" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Description:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->description }}" name="description" placeholder="Enter Description" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Specification:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->specification }}" name="specification" placeholder="Enter Specification" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Type:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-items"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->type }}" name="type" placeholder="Enter Type" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Quantity:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-items"></i></span>
                                        <input type="number" class="form-control" value="{{ $row->quanty }}" name="quanty" placeholder="Enter Quantity" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Buying Price</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" name="buyingPrice" value="{{ $row->buyingPrice }}" placeholder="Enter Buying Price" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Selling Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="sellingPrice" value="{{ $row->sellingPrice }}" placeholder="Enter Account Name" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Product">
                                    </div>
                            </form>




                      </div>
                    </div>
                  </div>
                </div>

            @endforeach
            
        </tbody>
    </table>  

            

        </div>
    </div>
</div>

{{-- Add supervisors Modal--}}

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Product Register Form</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addWarehouse" method="post">
              @csrf

                    <div class="form-group">
                        <label for="u_name" class="text-info">Description:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input type="text" class="form-control" name="description" placeholder="Enter Description" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Specification:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input type="text" class="form-control" name="specification" placeholder="Enter Specification" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Type:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-item"></i></span>
                        <input type="text" class="form-control" name="type" placeholder="Enter Type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Quantity:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="quanty" placeholder="Enter Quantity" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Buying Price</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="buyingPrice" placeholder="Enter Buying Price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Selling Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="sellingPrice" placeholder="Enter Selling Price" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Add Product">
                    </div>
            </form>
      </div>
    </div>
  </div>
</div>
