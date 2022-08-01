<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
            {{-- <img src="{{ asset('/storage/maintenance_image/8.jpg') }}" width="400" class="img img-thumbnail"> --}}
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> MAINTENANCE REQUEST
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Make Request</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Car Details</th>
                <th>Maintenance Type</th>
                <th>Location</th>
                <th>Garage Name</th>                
                <th>Price</th>  
                <th>Picture</th>   
                <th>Status</th>             
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenance as $row)
            <tr>
                <td>{{ $row->plateNumber}}</td>
                <td>{{ $row->maintenanceType }}</td>
                <td>{{ $row->maintenanceLocation }}</td>
                <td>{{ $row->garageName }}</td>
                <td>{{ $row->maintenancePrice }}</td>
                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pic{{ $row->maintenance_id }}">View</button></td>
                <td>{{ $row->maintenanceStatus }}</td>
                <td>{{ $row->created_at }}</td>
                <td>
                    <button @if($row->maintenanceStatus != 'Pending'){{ 'disabled' }} @endif class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->maintenance_id }}"><i class="fa fa-edit"></i></button>
                    <button @if($row->maintenanceStatus != 'Pending'){{ 'disabled' }} @endif class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->maintenance_id }}"><i class="fa fa-times"></i></button>
                </td>
            </tr>

            {{-- image supervisors Modal--}}

                <div class="modal fade" id="pic{{ $row->maintenance_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-info" id="myModalLabel">REPLACEMENT PICTURE</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        <img src="{{ asset('/storage/maintenance_image/'.$row->maintenance_id.'.jpg') }}" width="400" class="img img-thumbnail">

                            <form class="form" action="/deleteRecord" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->maintenance_id }}">
                              <input type="hidden" name="accType" value="finance">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                                <a href="{{ asset('/storage/maintenance_image/'.$row->maintenance_id.'.jpg') }}" download="{{ $row->firstName.' '.$row->lastName.'.jpg' }}" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>

            {{-- accept supervisors Modal--}}

                <div class="modal fade" id="accept{{ $row->maintenance_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        YOU ARE ABOUT TO <b>ACCEPT</b> THIS REQUEST

                            <form class="form" action="/acceptMaintenance" method="post">
                              @csrf
                              <input type="hidden" name="maintenance_id" value="{{ $row->maintenance_id }}">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-success">Yes Accept</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>


            
            {{-- delete supervisors Modal--}}

                <div class="modal fade" id="delete{{ $row->maintenance_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        COMFIRM DELETE ACTION

                            <form class="form" action="/deleteRecord" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->maintenance_id }}">
                              <input type="hidden" name="page" value="maintenance">
                                    
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

                <div class="modal fade" id="edit{{ $row->maintenance_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Request</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/editMaintenance" method="post" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="maintenance_id" value="{{ $row->maintenance_id }}">
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Car Details:</label><br>
                                        <select class="form-control" id="select_table" name="car_id" required>
                                        <option value="{{ $row->car_id }}">Select Car</option>
                                        @foreach($cars as $rows)
                                        <option value="{{ $rows->car_id }}">{{ $rows->plateNumber  }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Maintenance Type</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->maintenanceType }}" name="maintenanceType" placeholder="Enter Maintenance Type" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Maintenance Location:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->maintenanceLocation }}" name="maintenanceLocation" placeholder="Enter Maintenance Location" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Garage Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->garageName }}" name="garageName" placeholder="Enter Garage Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Maintenance Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" value="{{ $row->maintenancePrice }}" name="maintenancePrice" placeholder="Enter Maintenance Price" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Change Replacement Picture:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-upload"></i></span>
                                        <input type="file" class="form-control" name="file" placeholder="Upload Replacement Picture">
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
        <h4 class="modal-title" id="myModalLabel">Maintenance Request</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addMaintenance" method="post" enctype="multipart/form-data">
              @csrf
                    <div class="form-group">
                        <label for="u_password" class="text-info">Car Details:</label><br>
                        <select class="form-control" id="select_table" name="car_id" required>
                        <option value="">Select Car</option>
                        @foreach($cars as $rows)
                        <option value="{{ $rows->car_id }}">{{ $rows->plateNumber  }}</option>
                        @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Maintenance Type</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="maintenanceType" placeholder="Enter Maintenance Type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Maintenance Location:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                        <input type="text" class="form-control" name="maintenanceLocation" placeholder="Enter Maintenance Location" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Garage Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" name="garageName" placeholder="Enter Garage Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Maintenance Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="maintenancePrice" placeholder="Enter Maintenance Price" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="u_name" class="text-info">Replacement Picture:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-upload"></i></span>
                        <input type="file" class="form-control" name="file" placeholder="Upload Replacement Picture" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Send Request">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>