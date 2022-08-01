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
                <th>Org. Phone</th>
                <th>Cars</th>
                <th>Activity Type</th>
                <th>Activity Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $row)
            @php
                $carList = json_decode($row->car_id);
                $x = 0; $lts = '';$y=0;
            @endphp
            <tr>
                <td>{{ $row->organizationName }}</td>
                <td>{{ $row->organizationPhone }}</td>
                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#car{{ $row->client_id }}">Cars</button></td>
                <td>{{ $row->clientActivity }}</td>
                <td>{{ $row->clientLocation }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $row->client_id }}"><i class="fa fa-edit"></i></button>
                </td>
            </tr>

            {{-- Car List Modal--}}

                <div class="modal fade" id="car{{ $row->client_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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

            {{-- edit supervisors Modal--}}

                <div class="modal fade" id="edit{{ $row->client_id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Vehicle</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/editClient" method="post">
                              @csrf
                              <input type="hidden" name="client_id" value="{{ $row->client_id }}">
                                    <div class="form-group">
                        <label for="u_password" class="text-info">Car Details:</label><br>

                                    <input type="hidden" name="supervisor_id" value="{{ session('supervisor_id') }}">

                                    <div class="dropdown" style="border: 0.1px solid #cccccc; width: 100%; padding: 6px;">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-car"></i>
                                                <span style="margin-left: 20px;">
                                                    Car List
                                                    <span class="pull-right"><i class="fa fa-arrow-down"></i></span>
                                                </span>
                                            </a>
                                            <div class="dropdown-menu" role="menu" style="width: 100%;border: 0.1px solid #cccccc;padding: 18px;">            
                                                @foreach($cars as $rows)
                                                <input style="width: 15px; height: 15px" type="checkbox" name="{{ $rows->car_id }}" value="{{ $rows->plateNumber }}"
                                                @if ($rows->client_id == $row->client_id)
                                                    checked
                                                @endif
                                                >
                                                <span>{{ $rows->plateNumber }}</span>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>                                  
                                    
                                    <div  class="form-group">
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
                                        <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Update">
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
