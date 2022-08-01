<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-home"></i> ORGANIZATIONS
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Register Organization</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Org. Name</th>
                <th>Vehicle</th>
                <th>Supervisor</th>
                <th>Activity Type</th>
                <th>Activity Location</th>
                <th>Price</th>
                <th>Contract Period</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $row)
            @php
                $carList = json_decode($row->vehicleId);
                $x = 0; $lts = '';

            @endphp
            <tr>
                <td>{{ $row->organizationName }}</td>
                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#car{{ $row->id }}">Vehicles</button></td>
                <td>{{ $row->fleetId }}</td>
                <td>{{ $row->activityType }}</td>
                <td>{{ $row->activityLocation }}</td>
                <td>{{ $row->organizationTotalPrice }}</td>
                <td>{{ $row->organizationContractEnd }}</td>
                <td>
                    <button disabled class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fa fa-edit"></i></button>
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

                            <form class="form" action="/deleteRecord" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->id }}">
                              <input type="hidden" name="page" value="client">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" class="btn btn-primary">Comfirm</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>
            {{-- Car List Modal--}}

                <div class="modal fade" id="car{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-info" id="myModalLabel">Car List</h6>
                      </div>
                      <div style="overflow: auto;" class="modal-body">
                        <ol>
                           <?php $x = 0; foreach($carList as $ll){ ?>
                            <li>{{ $carList[$x] }}</li>
                           <?php $x++;}  ?>
                        </ol>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            {{-- edit Organization Modal--}}

                {{-- <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Organization</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/editOrganization" method="post">
                              @csrf
                              <input type="hidden" name="client_id" value="{{ $row->id }}">
                                    <div class="form-group">
                        <label for="u_password" class="text-info">Car Details:</label><br>

                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Supervisor Info:</label><br>
                                        <select class="form-control" id="select_table" name="supervisor_id" required>
                                        <option  value="{{ $row->id }}">{{ $row->id }} Selected</option>
                                        @foreach($supervisors as $list)
                                        <option value="{{ $list->id }}">{{ $list->firstName.' '.$list->lastName }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Organization Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->organizationName }}" name="organizationName" placeholder="Enter Organization name" required>
                                        </div>
                                    </div>                                  
                                    
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Activity Type:</label><br>
                                        <select class="form-control" id="select_table" name="clientActivity" required>
                                        <option value="{{ $row->clientActivity }}">{{ $row->clientActivity }} Selected</option>
                                        <option value="Day">Day</option>
                                        <option value="Night">Night</option>
                                        <option value="Day and Night">Day and Night</option>
                                       </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Activity Location:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <input type="text" class="form-control" value="{{ $row->clientLocation }}" name="clientLocation" placeholder="Enter Activity Location" required>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" value="{{ $row->clientPrice }}" name="clientPrice" placeholder="Enter Price" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Contract Start at:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-clock"></i></span>
                                        <input type="date" class="form-control" value="{{ $row->clientContractStart }}" name="clientContractStart" placeholder="Enter Contract Starting Date" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_phone" class="text-info">Contract End at:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-clock"></i></span>
                                        <input type="date" class="form-control" value="{{ $row->clientContractEnd }}" name="clientContractEnd" placeholder="Enter Contract Ending Date" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Client">
                                    </div>
                            </form>


                      </div>
                    </div>
                  </div>
                </div> --}}

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
        <h4 class="modal-title" id="myModalLabel">Register Organization</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">

            <form class="form" action="/addOrganization" method="post">
              @csrf

                    <div class="form-group">
                        <label for="u_name" class="text-info">Organization Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" name="organizationName" placeholder="Enter Organization name" required>
                        </div>
                    </div>                                 
                    
                    <div class="form-group">
                        <label for="u_password" class="text-info">Activity Type:</label><br>
                        <select class="form-control" id="select_table" name="activityType" required>
                        <option value="">Select Activity Type</option>
                        <option value="Day">Day</option>
                        <option value="Night">Night</option>
                        <option value="Day and Night">Day and Night</option>
                        <option value="One Way Trip">Trip (One Way)</option>
                        <option value="Round Trip">Trip (Round Trip)</option>
                       </select>
                    </div>

                    <div class="form-group">
                        <label for="u_name" class="text-info">Vehicle Type:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input type="text" class="form-control" name="vehicleType" placeholder="Enter Vehicle Type" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="u_name" class="text-info">Activity Location:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                        <input type="text" class="form-control" name="activityLocation" placeholder="Enter Activity Location" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Price Daily:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input id="price" type="number" class="form-control" name="organizationPrice" oninput="getPrice()" placeholder="Enter Price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Contract Start at:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa-solid fa-clock"></i></span>
                        <input id="start" type="date" class="form-control" name="organizationContractStart" placeholder="Enter Contract Starting Date" onchange="getDay()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_phone" class="text-info">Contract End at:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa-solid fa-clock"></i></span>
                        <input id="end" type="date" class="form-control" name="organizationContractEnd" placeholder="Enter Contract Ending Date" onchange="getDay()" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="u_phone" class="text-info">Total Days:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input id="totalDays" type="number" class="form-control" name="organizationContractDays" placeholder="Total Days" readonly required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="u_phone" class="text-info">Total Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input id="totalPrice" type="number" class="form-control" name="organizationTotalPrice" placeholder="Total Price" readonly required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Register Organization">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>

<script>
function getPrice(){
    var price = Number(document.getElementById('price').value);
    var totalDays = Number(document.getElementById('totalDays').value);
    document.getElementById('totalPrice').value = price * totalDays;
}
function getDay(){
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;
    var date1 = new Date(start);
    var date2 = new Date(end);
    var Difference_In_Time = date2.getTime() - date1.getTime();
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    document.getElementById('totalDays').value = Difference_In_Days;

    getPrice();
}

</script>