<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> FUEL DEPARTMENT
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Fuel Officer</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Filling Station</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuelDepartment as $row)
            <tr>
                <td>{{ $row->firstName }}</td>
                <td>{{ $row->lastName }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->fillingStationId }}</td>
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

                            <form class="form" action="/deleteFleetOfficer" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->userId }}">
                              <input type="hidden" name="page" value="fleet Officer">
                                    
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
                        <h4 class="modal-title" id="myModalLabel">Edit Supervisor</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateFuelDepartment" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->userId }}">
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">First Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="firstName" value="{{ $row->firstName }}" placeholder="Enter First name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Last Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="lastName" value="{{ $row->lastName }}" placeholder="Enter Last name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Email:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" value="{{ $row->email }}" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Phone:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" name="phone" value="{{ $row->phone }}" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info">Filling Station:</label><br>
                                        <select class="form-control" id="select_table" name="fillingStationId" required>
                                        <option  value="{{ $row->fillingStationId }}">{{ $row->fillingStationId }} Selected</option>
                                        @foreach($fillingStation as $list)
                                        <option value="{{ $list->id }}">{{ $list->fillingStationName }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Supervisor">
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
        <h4 class="modal-title" id="myModalLabel">Create Supervisor</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addFuelDepartment" method="post">
              @csrf
                    <div class="form-group">
                        <label for="u_name" class="text-info">First Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="firstName" placeholder="Enter First name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Last Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="lastName" placeholder="Enter Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Email:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Phone:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_password" class="text-info">Filling Station:</label><br>
                        <select class="form-control" id="select_table" name="fillingStationId" required>
                        <option  value=""> Select Filling Station</option>
                        @foreach($fillingStation as $list)
                        <option value="{{ $list->fillingStationName }}">{{ $list->fillingStationName }}</option>
                        @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="u_password" class="text-info">Password:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Register">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>