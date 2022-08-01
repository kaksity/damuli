<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="vehicled-header alert alert-info">
            <i class="fa fa-user"></i> VEHICLE
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Vehicle</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>vehicle Name</th>
                <th>vehicle Type</th>
                <th>vehicle Color</th>
                <th>Plate Number</th>
                <th>vehicle Owner Name</th>
                <th>vehicle Owner Phone</th>
                {{-- <th>vehicle Driver Name</th>
                <th>vehicle Driver Phone</th> --}}
                <th>Fleet Officer</th>              
                <th>vehicle Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $row)
            <tr>
                <td>{{ $row->vehicleName }}</td>
                <td>{{ $row->vehicleType }}</td>
                <td>{{ $row->vehicleColor }}</td>
                <td>{{ $row->vehiclePlateNumber }}</td>
                <td>{{ $row->vehicleOwnerName }}</td>
                <td>{{ $row->vehicleOwnerPhone }}</td>
                {{-- <td>{{ $row->vehicleDriverName }}</td>
                <td>{{ $row->vehicleDriverPhone }}</td> --}}
                <td>{{ $row->fleetId }}</td>
                <td>{{ $row->vehicleStatus }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fa fa-edit"></i></button>
                    <button disabled class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->id }}"><i class="fa fa-times"></i></button>
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

                            <form class="form" action="/deleteVehicle" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->id }}">
                              <input type="hidden" name="page" value="vehicle">
                                    
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
                        <h4 class="modal-title" id="myModalLabel">Edit Vehicle</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateVehicle" method="post">
                              @csrf
                              <input type="hidden" name="vehicle_id" value="{{ $row->id }}">
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">vehicle Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                                        <input type="text" class="form-control" name="vehicleName" value="{{ $row->vehicleName }}" placeholder="Enter vehicle name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">vehicle Type:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                                        <input type="text" class="form-control" name="vehicleType" value="{{ $row->vehicleType }}" placeholder="Enter vehicle Type" required>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Color:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                                        <input type="text" class="form-control" name="vehicleColor" value="{{ $row->vehicleColor }}" placeholder="Enter vehicle Color" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Plate Number:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                                        <input type="text" class="form-control" name="plateNumber" value="{{ $row->vehiclePlateNumber }}" placeholder="Enter Plate Number" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">vehicle Owner Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="tel" class="form-control" name="vehicleOwnerName" value="{{ $row->vehicleOwnerName }}" placeholder="Enter vehicle Owner Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">vehicle Owner Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" name="vehicleOwnerPhone" value="{{ $row->vehicleOwnerPhone }}" placeholder="Enter vehicle Owner Phone">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="u_phone" class="text-info">vehicle Driver Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="tel" class="form-control" name="vehicleDriverName" value="{{ $row->vehicleDriverName }}" placeholder="Enter vehicle Owner Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">vehicle Driver Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" name="vehicleDriverPhone" value="{{ $row->vehicleDriverPhone }}" placeholder="Enter vehicle Owner Phone">
                                        </div>
                                    </div> --}}
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update vehicle">
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
        <h4 class="modal-title" id="myModalLabel">Create Vehicle</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addVehicle" method="post">
              @csrf
                    <div class="form-group">
                        <label for="u_name" class="text-info">vehicle Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                        <input type="text" class="form-control" name="vehicleName" placeholder="Enter vehicle name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">vehicle Type:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                        <input type="text" class="form-control" name="vehicleType" placeholder="Enter vehicle Type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Color:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                        <input type="text" class="form-control" name="vehicleColor" placeholder="Enter vehicle Color" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Plate Number:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-vehicle"></i></span>
                        <input type="text" class="form-control" name="vehiclePlateNumber" placeholder="Enter Plate Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">vehicle Owner Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="tel" class="form-control" name="vehicleOwnerName" placeholder="Enter vehicle Owner Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">vehicle Owner Phone:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="form-control" name="vehicleOwnerPhone" placeholder="Enter vehicle Owner Phone">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="u_phone" class="text-info">vehicle Driver Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="tel" class="form-control" name="vehicleDriverName" placeholder="Enter vehicle Driver Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">vehicle Driver Phone:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="form-control" name="vehicleDriverPhone" placeholder="Enter vehicle Driver Phone">
                        </div>
                    </div> --}}
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Register vehicle">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>