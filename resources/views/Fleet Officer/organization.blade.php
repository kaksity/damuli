<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-home"></i> ORGANIZATION
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Org. Name</th>
                <th>Cars</th>
                <th>Activity Type</th>
                <th>Activity Location</th>
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
                <td>{{ $row->activityType }}</td>
                <td>{{ $row->activityLocation }}</td>
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

                <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Organization's Activity</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateOrganization" method="post">
                              @csrf
                              
                                    <div class="form-group">
                                    <label for="u_password" class="text-info">Vehicle Details:</label><br>

                                    <input type="hidden" name="fleetId" value="{{ session('fleetId') }}">
                                    <input type="hidden" name="organizationId" value="{{ $row->id }}">

                                    <div class="dropdown" style="border: 0.1px solid #cccccc; width: 100%; padding: 6px;">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-car"></i>
                                                <span style="margin-left: 20px;">
                                                    Vehicle List
                                                    <span class="pull-right"><i class="fa fa-arrow-down"></i></span>
                                                </span>
                                            </a>
                                            <div class="dropdown-menu" role="menu" style="width: 100%;border: 0.1px solid #cccccc;padding: 18px;">            
                                                @foreach($vehicle as $rows)
                                                <input style="width: 15px; height: 15px" type="checkbox" name="{{ $rows->id }}" value="{{ $rows->vehiclePlateNumber }}"
                                                @if ($rows->organizationId == $row->id)
                                                    checked
                                                @endif
                                                >
                                                <span>{{ $rows->vehiclePlateNumber }}</span>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Activity Type:</label><br>
                                        <select class="form-control" id="select_table" name="activityType" required>
                                        <option value="{{ $row->activityType }}">Select Activity Type</option>
                                        <option value="Day">Day</option>
                                        <option value="Night">Night</option>
                                        <option value="Day and Night">Day and Night</option>
                                        <option value="One Way Trip">Trip (One Way)</option>
                                        <option value="Round Trip">Trip (Round Trip)</option>
                                       </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Activity Location:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <input type="text" class="form-control" name="activityLocation" value="{{ $row->activityLocation }}" placeholder="Enter Activity Location" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update Organization">
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

{{-- <form class="form" action="/test" method="post">
    @csrf
    <div class="form-group col-md-12">
        <div class="input-group" id="form">
        </div>        
    </div>

    <button>Submit</button>
</form>
<button onclick="subInput()">Sub</button><button onclick="addInput()">Add</button> --}}
 

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
var i=1;
function addInput(){
    var vehicle = document.createElement("input");
    var type = document.createElement("input");
    var price = document.createElement("input");
    var br1 = document.createElement("br");
    var br2 = document.createElement("br");
    var br3 = document.createElement("br");
    var br4 = document.createElement("br");
    var br5 = document.createElement("br");
    var br6 = document.createElement("br");
    var vehicleLabel = document.createElement("label");
    var typeLabel = document.createElement("label");
    var priceLabel = document.createElement("label");
    var h4 = document.createElement("h4");

    vehicle.type = "text";
    vehicle.value = i;
    vehicle.className += "form-control";
    vehicle.name = "vehicle"+i;

    type.type = "text";
    type.value = i;
    type.className += "form-control";
    type.name = "type"+i;
    type.style.width = '800px';

    price.type = "text";
    price.value = i;
    price.className += "form-control";
    price.name = "price"+i;

    vehicleLabel.innerHTML = "Vehicle Plate Number";
    typeLabel.innerHTML = "Vehicle Type";
    priceLabel.innerHTML = "Vehicle Price";
    h4.innerHTML = "Vehicle "+i;

    document.getElementById('form').appendChild(h4);

    document.getElementById('form').appendChild(vehicleLabel);
    document.getElementById('form').appendChild(br1);
    document.getElementById('form').appendChild(vehicle);
    document.getElementById('form').appendChild(br2);

    document.getElementById('form').appendChild(typeLabel);
    document.getElementById('form').appendChild(br3);
    document.getElementById('form').appendChild(type);
    document.getElementById('form').appendChild(br4);

    document.getElementById('form').appendChild(priceLabel);
    document.getElementById('form').appendChild(br5);
    document.getElementById('form').appendChild(price);
    document.getElementById('form').appendChild(br6);
    i++;
}

function addInput2(){

  var content = '<input type="search" class="form-control" name="name'+i+'">';
  $("#form").append(content)
i++;
}

function subInput(){
for(var r = 0; r < 13; r++){
  const list = document.getElementById("form");
  list.removeChild(list.lastElementChild);  
}
let numb = document.getElementById("form").childElementCount;
numb = numb/13;
i = numb+1;
}

</script>