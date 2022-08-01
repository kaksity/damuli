@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> FUEL DATA ENTRY
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Data</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Fleet Officer</th>
                <th>Litre</th>
                <th>Price Per Litre</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuelData as $row)
            <tr>
                <td>{{ $row->vehicleId }}</td>
                <td>{{ $fleetId = FleetOfficer::where(['id' => $row->fleetId])->value('firstName') }}</td>                
                <td>{{ $row->fuelLitre }}</td>
                <td>{{ $row->fuelPrice }}</td>
                <td>{{ $row->fuelTotalPrice }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fa fa-edit"></i></button>
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

                            <form class="form" action="/deleteRecord" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->id }}">
                              <input type="hidden" name="accType" value="finance">
                                    
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
                        <h4 class="modal-title" id="myModalLabel">Update Fuel Data Entry</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateFuelData" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                                    <div class="form-group">
                                        <label for="u_password" class="text-info">Car Details:</label><br>
                                        <select class="form-control" id="select_table" name="vehicleId" required>
                                        <option value="{{ $row->vehiclePlateNumber }}">Select Car</option>
                                        @foreach($vehicle as $rows)
                                        <option value="{{ $rows->vehiclePlateNumber }}">{{ $rows->vehiclePlateNumber }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_email" class="text-info">Litre Comsumption</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="number" id="litres{{ $row->id }}" oninput="fuels('{{ 'litres'.$row->id }}','{{ 'prices'.$row->id }}','{{ 'totalPrices'.$row->id }}')" class="form-control" name="fuelLitre" value="{{ $row->fuelLitre }}" placeholder="Enter Litre Comsumption" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Price Per Litre:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" id="prices{{ $row->id }}" oninput="fuels('{{ 'litres'.$row->id }}','{{ 'prices'.$row->id }}','{{ 'totalPrices'.$row->id }}')" class="form-control" name="fuelPrice" value="{{ $row->fuelPrice }}" placeholder="Enter Price" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Total Fuel Price:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="totalPrices{{ $row->id }}" readonly type="number" class="form-control" name="fuelTotal" placeholder="Total Fuel Price" value="{{ $row->fuelTotalPrice }}" required>
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
        <h4 class="modal-title" id="myModalLabel">Fuel Data Entry</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addFuelData" method="post">
              @csrf
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
                        <label for="u_email" class="text-info">Litre Comsumption</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input id="litre" oninput="fuel()" type="number" class="form-control" name="fuelLitre" placeholder="Enter Litre Comsumption" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Price Per Litre:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input id="price" oninput="fuel()" type="number" class="form-control" name="fuelPrice" placeholder="Enter Price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Total Fuel Price:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input id="totalPrice" readonly type="number" class="form-control" name="fuelTotal" placeholder="Total Fuel Price" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Add Fuel Data Entry">
                    </div>
            </form>




      </div>
    </div>
  </div>
</div>
<script>
    function fuel(){
        var litre = Number(document.getElementById('litre').value);
        var price = Number(document.getElementById('price').value);
        document.getElementById('totalPrice').value = litre*price;
    }
    function fuels(pid = '', lid = '',tpid = ''){
        var litre = Number(document.getElementById(lid).value);
        var price = Number(document.getElementById(pid).value);
        document.getElementById(tpid).value = litre*price;
    }
</script>