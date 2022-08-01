<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> VEHICLE
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Vehicle</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Car Name</th>
                <th>Car Type</th>
                <th>Car Color</th>
                <th>Plate Number</th>
                <th>Active</th>
                <th>Maintenance</th>
                <th>Onhold</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $row)
            <tr>
                <td>{{ $row->carName }}</td>
                <td>{{ $row->carType }}</td>
                <td>{{ $row->carColor }}</td>
                <td>{{ $row->plateNumber }}</td>

            <form class="form" action="/carStatus" method="post">
              @csrf
              <input type="hidden" name="car_id" value="{{ $row->car_id }}">

                <td><input type="radio" name="{{ 'status'.$row->car_id }}" value="Active"
                @if ($row->carStatus == 'Active')
                    checked
                @endif
                ></td>
                <td><input type="radio" name="{{ 'status'.$row->car_id }}" value="Maintenance"
                @if ($row->carStatus == 'Maintenance')
                checked
                @endif
                ></td>
                <td><input type="radio" name="{{ 'status'.$row->car_id }}" value="Onhold"
                @if ($row->carStatus == 'Onhold')
                    checked
                @endif
                ></td>
                {{-- Update Car Status Modal--}}

                {{-- <div class="modal fade" id="update{{ $row->car_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        COMFIRM ACTION
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" class="btn btn-primary">Comfirm</button>
                              </div>
                            

                      </div>
                    </div>
                  </div>
                </div> --}}

                

                <td>
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-upload"></i>
                    </button>
                </td>
            </form>
            </tr>
            
            {{-- edit supervisors Modal--}}

                <div class="modal fade" id="edit{{ $row->car_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Vehicle</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/editVehicle" method="post">
                              @csrf
                              <input type="hidden" name="car_id" value="{{ $row->car_id }}">
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Car Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control" name="carName" value="{{ $row->carName }}" placeholder="Enter Car name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Car Type:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control" name="carType" value="{{ $row->carType }}" placeholder="Enter Car Type" required>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Color:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control" name="carColor" value="{{ $row->carColor }}" placeholder="Enter Car Color" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Plate Number:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control" name="plateNumber" value="{{ $row->plateNumber }}" placeholder="Enter Plate Number" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Car Owner Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="tel" class="form-control" name="carOwnerName" value="{{ $row->carOwnerName }}" placeholder="Enter Car Owner Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Car Owner Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" name="carOwnerPhone" value="{{ $row->carOwnerPhone }}" placeholder="Enter Car Owner Phone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Car Driver Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="tel" class="form-control" name="carDriverName" value="{{ $row->carDriverName }}" placeholder="Enter Car Owner Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Car Driver Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" name="carDriverPhone" value="{{ $row->carDriverPhone }}" placeholder="Enter Car Owner Phone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Supervisor:</label><br>
                                        <select class="form-control" id="select_table" name="supervisor_id" required>
                                        <option value="{{ $row->supervisor_id  }}">Select Supervisor</option>
                                        @foreach($supervisors as $rows)
                                        <option value="{{ $rows->supervisor_id }}">{{ $rows->firstName.' '.$rows->lastName }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Car">
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
                        <label for="u_name" class="text-info">Car Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="carName" placeholder="Enter Car name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Car Type:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="carType" placeholder="Enter Car Type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Color:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="carColor" placeholder="Enter Car Color" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Plate Number:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="plateNumber" placeholder="Enter Plate Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Car Owner Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="tel" class="form-control" name="carOwnerName" placeholder="Enter Car Owner Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Car Owner Phone:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="form-control" name="carOwnerPhone" placeholder="Enter Car Owner Phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Car Driver Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="tel" class="form-control" name="carDriverName" placeholder="Enter Car Driver Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Car Driver Phone:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="form-control" name="carDriverPhone" placeholder="Enter Car Driver Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_password" class="text-info">Supervisor:</label><br>
                        <select class="form-control" id="select_table" name="supervisor_id" required>
                        <option value="">Select Supervisor</option>
                        @foreach($supervisors as $rows)
                        <option value="{{ $rows->supervisor_id }}">{{ $rows->firstName.' '.$rows->lastName }}</option>
                        @endforeach
                       </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Register Car">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>