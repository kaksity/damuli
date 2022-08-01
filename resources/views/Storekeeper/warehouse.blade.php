@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> PRODUCTS
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
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}">Out</button>
                </td>
            </tr>

            {{-- edit supervisors Modal--}}

                <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Fuel Request</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/outWarehouse" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                              <input type="hidden" name="sellingPrice" value="{{ $row->sellingPrice }}">
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Vehicle Details:</label><br>
                                        <select class="form-control" id="select_table" name="vehicleId" required>
                                        <option value="">Select Car</option>
                                        @foreach($vehicle as $rows)
                                        <option value="{{ $rows->vehiclePlateNumber }}">{{ $rows->vehiclePlateNumber  }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Quantity:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Receiver Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="receiverName" placeholder="Enter Receiver Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Receiver Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="number" class="form-control" name="receiverPhone" placeholder="Enter Receiver Phone" required>
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
