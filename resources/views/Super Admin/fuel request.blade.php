@php 
use App\Models\FleetOfficer;
@endphp
<div>
    <div  class="row justify-content-center align-items-center center">
        <div class="col-md-12 col-xs-12">
        <div class="card-header alert alert-info">
            <i class="fa fa-user"></i> FUEL REQUEST
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Litre</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Account No.</th>
                <th>Account Name</th>
                <th>Bank Name</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuelRequest as $row)
            <tr>
                <td>{{ $row->fuelLitre }}</td>               
                <td>{{ $row->fuelPrice }}</td>
                <td>{{ $row->fuelTotalPrice }}</td>
                <td>{{ $row->accountNumber }}</td>
                <td>{{ $row->accountName }}</td>
                <td>{{ $row->bankName }}</td>
                <td>{{ $row->fuelComment }}</td>
                <td>{{ $row->fuelRequestStatus }}</td>
                <td>
                    <button
                    @if($row->fuelRequestStatus == 'Approved' ||
                        $row->fuelRequestStatus == 'Paid'
                    )
                        {{ 'disabled' }}
                    @endif
                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#accept{{ $row->id }}"><i class="fa fa-edit"></i></button>
                    <button
                    @if($row->fuelRequestStatus == 'Approved' ||
                        $row->fuelRequestStatus == 'Paid'
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
                        <?php
                            $content = '';
                            if($row->fuelRequestStatus == 'Pending')
                            $content = 'VERIFY';
                            if($row->fuelRequestStatus == 'Verified')
                            $content = 'APPROVE';
                        ?>
                        
                        YOU ARE ABOUT TO <b>{{ $content }}</b> THIS REQUEST

                            <form class="form" action="/acceptFuelRequest" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                              @if($row->fuelRequestStatus == 'Pending')
                              <input type="hidden" name="fuelRequestStatus" value="Verified">
                              @endif
                              @if($row->fuelRequestStatus == 'Verified')
                              <input type="hidden" name="fuelRequestStatus" value="Approved">
                              @endif
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">No</button>
                                <button type="submit" class="btn btn-success">Yes {{ ucfirst(strtolower($content)) }}</button>
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

                            <form class="form" action="/rejectFuelRequest" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $row->id }}">
                              <input type="hidden" name="fuelRequestStatus" value="Rejected">
                                    
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