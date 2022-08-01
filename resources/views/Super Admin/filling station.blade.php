<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> FILLING STATIONS
            <button href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>Add Filling Station</button>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Litres</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fillingStation as $row)
            <tr>
                <td>{{ $row->fillingStationName }}</td>
                <td>{{ $row->fillingStationLocation }}</td>
                <td>{{ $row->fillingStationLitres }}</td>
                <td>{{ $row->fillingStationBalance }}</td>
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
                        <h4 class="modal-title" id="myModalLabel">Edit Filling Station</h4>
                      </div>
                      <div style="overflow: auto;" class="modal-body">



                            <form class="form" action="/updateFillingStation" method="post">
                              @csrf
                              <input type="hidden" name="user_id" value="{{ $row->id }}">
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Name:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" name="name" value="{{ $row->fillingStationName }}" placeholder="Enter First name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="u_name" class="text-info">Location:</label><br>
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <input type="text" class="form-control" name="location" value="{{ $row->fillingStationLocation }}" placeholder="Enter Filling Station Location" required>
                                        </div>
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
        <h4 class="modal-title" id="myModalLabel">Create Filling Station</h4>
      </div>
      <div style="overflow: auto;" class="modal-body">



            <form class="form" action="/addFillingStation" method="post">
              @csrf
                    <div class="form-group">
                        <label for="u_name" class="text-info">Name:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Enter Filling Station Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_name" class="text-info">Location:</label><br>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                        <input type="text" class="form-control" name="location" placeholder="Enter Filling Station Location" required>
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