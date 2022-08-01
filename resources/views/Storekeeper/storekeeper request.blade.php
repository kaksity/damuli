@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> STOREKEEPER REQUEST
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Make Request</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Description</th>
                <th>Specification</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Account Number</th>
                <th>Account Name</th>
                <th>Bank Name</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($request as $row)
            <tr>
                <td>{{ $row->description }}</td>               
                <td>{{ $row->specification }}</td>               
                <td>{{ $row->quanty }}</td>               
                <td>{{ $row->unitPrice }}</td>
                <td>{{ $row->totalPrice }}</td>
                <td>{{ $row->accountNumber }}</td>
                <td>{{ $row->accountName }}</td>
                <td>{{ $row->bankName }}</td>
                <td>{{ $row->comment }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <button @if($row->status != 'Pending'){{ 'disabled' }} @endif class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fa fa-edit"></i></button>
                    <button @if($row->status != 'Pending'){{ 'disabled' }} @endif class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->id }}"><i class="fa fa-times"></i></button>
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

                            <form class="form" action="/deleteStorekeeperRequest" method="post">
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
                        <h4 class="modal-title" id="myModalLabel">Update Storekeeper Request</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateStorekeeperRequest" method="post">
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
                                        <label for="u_name" class="text-info">Quantity:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="number" class="form-control" value="{{ $row->quanty }}" name="quanty" placeholder="Enter Quantity" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Unit Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" value="{{ $row->unitPrice }}" name="unitPrice" placeholder="Enter Amount" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Account Number</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" name="accountNumber" value="{{ $row->accountNumber }}" placeholder="Enter Account Number" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Account Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="accountName" value="{{ $row->accountName }}" placeholder="Enter Account Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Bank Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" name="bankName" value="{{ $row->bankName }}" placeholder="Enter Bank Name" required>
                                        </div>
                                    </div>                    
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Comment:</label><br>
                                        <div class="input-group">
                                            <textarea rows="4" cols="4000" name="comment" class="form-control">{{ $row->comment }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Request">
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
        <h4 class="modal-title" id="myModalLabel">Storekeeper Request Form</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addStorekeeperRequest" method="post">
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
                        <label for="u_name" class="text-info">Quantity:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <input type="number" class="form-control" name="quanty" placeholder="Enter Quantity" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Unit Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="unitPrice" placeholder="Enter Amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Account Number</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="accountNumber" placeholder="Enter Account Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Account Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="accountName" placeholder="Enter Account Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Bank Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" name="bankName" placeholder="Enter Bank Name" required>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="u_name" class="text-info">Comment:</label><br>
                        <div class="input-group">
                            <textarea rows="4" cols="4000" name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Send Maintenance Request">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>
