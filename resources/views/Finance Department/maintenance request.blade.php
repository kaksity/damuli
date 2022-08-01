@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> MAINTENANCE REQUEST
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Maintenance Type</th>
                <th>Maintenance Price</th>
                <th>Account Number</th>
                <th>Account Name</th>
                <th>Bank Name</th>
                <th>Maintenance Comment</th>
                <th>Maintenance Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicleMaintenance as $row)
            <tr>
                <td>{{ $row->maintenanceType }}</td>               
                <td>{{ $row->maintenanceTotalPrice }}</td>
                <td>{{ $row->accountNumber }}</td>
                <td>{{ $row->accountName }}</td>
                <td>{{ $row->bankName }}</td>
                <td>{{ $row->maintenanceComment }}</td>
                <td>{{ $row->maintenanceStatus }}</td>
                <td>
                    <button
                    @if($row->maintenanceStatus == 'Rejected' ||
                        $row->maintenanceStatus == 'Paid'
                    )
                        {{ 'disabled' }}
                    @endif
                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#accept{{ $row->id }}"><i class="fa fa-edit"></i></button>
                    <button
                    @if($row->maintenanceStatus == 'Rejected' ||
                        $row->maintenanceStatus == 'Paid'
                    )
                        {{ 'disabled' }}
                    @endif                    
                    class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject{{ $row->id }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            
            {{-- accept request Modal--}}

                <div class="modal fade" id="accept{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">
                        
                        YOU ARE ABOUT TO <b>PAY</b> THIS REQUEST

                            <form class="form" action="/acceptMaintenanceRequest" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                              <input type="hidden" name="maintenanceStatus" value="Paid">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-success">Yes Pay</button>
                              </div>
                            </form>

                      </div>
                    </div>
                  </div>
                </div>
            {{-- Reject request Modal--}}

                <div class="modal fade" id="reject{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title alert alert-warning" id="myModalLabel">WARNING!!!</h6>
                      </div>
                      <div style="overflow: auto; text-align: center;" class="modal-body">

                        YOU ARE ABOUT TO <b>REJECT</b> THIS REQUEST

                            <form class="form" action="/rejectMaintenanceRequest" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                              <input type="hidden" name="maintenanceStatus" value="Rejected">
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-danger">Yes Reject</button>
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