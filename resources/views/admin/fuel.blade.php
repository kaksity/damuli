<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> FUEL REQUEST
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Make Request</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Car Details</th>
                <th>Litre Comsumption</th>
                <th>Price Per Litre</th>
                <th>Total Price</th>
                <th>Activity Location</th>
                <th>Filling Station</th>                
                <th>Supervisor</th>                                
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuels as $row)
            <tr>
                <td>{{ $row->plateNumber }}</td>
                <td>{{ $row->litre }}</td>
                <td>{{ $row->price }}</td>
                <td>{{ $row->totalPrice }}</td>
                <td>{{ $row->location }}</td>
                <td>{{ $row->fillingStation }}</td>
                <td>{{ $row->firstName.' '.$row->lastName }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <button 
                    @if($row->status != 'Pending' && (session('position') == 'Managing Director' || session('position') == 'Director Operation'))
                        {{ 'disabled' }}
                    @endif
                    @if(($row->status == 'Approved' ||
                        $row->status == 'Rejected' ||
                        $row->status == 'Pending' ||
                        $row->status == 'Paid') &&
                        (session('position') == 'HR Director'))
                        {{ 'disabled' }}
                    @endif
                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#accept{{ $row->fuel_id }}"><i class="fa fa-check"></i></button>
                    <button
                    @if($row->status != 'Pending' && (session('position') == 'Managing Director' || session('position') == 'Director Operation'))
                        {{ 'disabled' }}
                    @endif
                    @if(($row->status == 'Approved' ||
                        $row->status == 'Rejected' ||
                        $row->status == 'Pending' ||
                        $row->status == 'Paid') &&
                        (session('position') == 'HR Director'))
                        {{ 'disabled' }}
                    @endif
                    class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject{{ $row->fuel_id }}"><i class="fa fa-times"></i></button>
                </td>
            </tr>

            {{-- accept supervisors Modal--}}

                <div class="modal fade" id="accept{{ $row->fuel_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        YOU ARE ABOUT TO <b>APPROVE</b> THIS REQUEST

                            <form class="form" action="/accept" method="post">
                              @csrf
                              <input type="hidden" name="fuel_id" value="{{ $row->fuel_id }}">
                              <input type="hidden" name="page" value="fuel">
                              @if(session('position') == 'Managing Director' || session('position') == 'Director Operation')
                              <input type="hidden" name="status" value="Verified">
                              @endif
                              @if(session('position') == 'HR Director')
                              <input type="hidden" name="status" value="Approved">
                              @endif
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-success">Yes Approve</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>


            {{-- Reject supervisors Modal--}}

                <div class="modal fade" id="reject{{ $row->fuel_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        YOU ARE ABOUT TO <b>REJECT</b> THIS REQUEST

                            <form class="form" action="/reject" method="post">
                              @csrf
                              <input type="hidden" name="fuel_id" value="{{ $row->fuel_id }}">
                              <input type="hidden" name="page" value="fuel">
                              <input type="hidden" name="status" value="Rejected">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-danger">Yes Reject</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>

            {{-- delete supervisors Modal--}}

                <div class="modal fade" id="delete{{ $row->fuel_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
                              <input type="hidden" name="user_id" value="{{ $row->fuel_id }}">
                              <input type="hidden" name="page" value="fuel">
                                    
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

                <div class="modal fade" id="edit{{ $row->fuel_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Request</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/editFuelRequest" method="post">
                              @csrf
                              <input type="hidden" name="fuel_id" value="{{ $row->fuel_id }}">
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Car Details:</label><br>
                                        <select class="form-control" id="select_table" name="car_id" required>
                                        <option value="{{ $row->car_id }}">Select Car</option>
                                        @foreach($cars as $rows)
                                        <option value="{{ $rows->car_id }}">{{ $rows->carName.' '.$rows->carType.' '.$rows->carColor  }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Litre Comsumption</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="number" class="form-control" name="litre" value="{{ $row->litre }}" placeholder="Enter Litre Comsumption" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Activity Location:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <input type="tel" class="form-control" name="location" value="{{ $row->location }}" placeholder="Enter Activity Location" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Filling Station:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" name="fillingStation" value="{{ $row->fillingStation }}" placeholder="Enter Filling Station" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" name="price" value="{{ $row->price }}" placeholder="Enter Price" required>
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
        <h4 class="modal-title" id="myModalLabel">Fuel Request</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addFuelRequest" method="post">
              @csrf
                    <div class="form-group">
                        <label for="u_password" class="text-info">Car Details:</label><br>
                        <select class="form-control" id="select_table" name="car_id" required>
                        <option value="">Select Car</option>
                        @foreach($cars as $rows)
                        <option value="{{ $rows->car_id }}">{{ $rows->carName.' '.$rows->carType.' '.$rows->carColor  }}</option>
                        @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="u_email" class="text-info">Litre Comsumption</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="number" class="form-control" name="litre" placeholder="Enter Litre Comsumption" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Activity Location:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                        <input type="tel" class="form-control" name="location" placeholder="Enter Activity Location" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Filling Station:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" name="fillingStation" placeholder="Enter Filling Station" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
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