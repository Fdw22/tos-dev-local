@extends('partial.main')
@section('content')
<div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Confirm Disch</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Confirmed Disch</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button class="btn icon icon-left btn-success" data-bs-toggle="modal"data-bs-target="#success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg> Confirmed</button>
                </div>
                <div class="card-body">
                    <table class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Container No</th>
                                <th>Crane Code</th>
                                <th>Operator</th>
                                <th>Confirmed At</th>
                            </tr>
                        </thead>
                        <tbody>          
                        @foreach($formattedData as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d['container_no']}}</td>
                            <td>{{$d['cc_tt_no']}}</td>
                            <td>{{$d['cc_tt_oper']}}</td>
                            <td>{{$d['update_time']}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Update Status -->
            <div class="modal fade text-left" id="success"  role="dialog"aria-labelledby="myModalLabel110" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title white" id="myModalLabel110">Confirm Disch</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"aria-label="Close"><i data-feather="x"></i></button>
                        </div>
                        <div class="modal-body">
                            <!-- form -->
                            
                                <div class="form-body">
                                    <div class="row">
                                    <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">No Alat</label>   
                                                <input type="text" id="no_alat" class="form-control" name="cc_tt_no" required>                                             
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Op Alat</label>   
                                                <input type="text" id="operator" class="form-control" name="cc_tt_oper" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Choose Container Number</label>   
                                                <select style="width:100%;"class="form-control container"  id="container_no" name="container_no" required>
                                                  <option value="">Select Container</option>
                                                  @foreach($items as $data)
                                                    <option value="{{$data->container_no}}">{{$data->container_no}}</option>
                                                  @endforeach
                                                </select>
                                                <input type="hidden" id="key" class="form-control" name="container_key">                                             
                                            </div>
                                            {{ csrf_field()}}
                                        </div>
                                        <div class="col-6" style="border:1px solid blue;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Kapal</label>   
                                                        <input type="text"  id="name" class="form-control" name="ves_name"  disabled>                                               
                                                    </div>
                                                </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">Slot</label>   
                                                            <input type="text"  id="slot" class="form-control"  name="bay_slot"  disabled>                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">Row</label>   
                                                            <input type="text"  id="row" class="form-control"  name="bay_row"  disabled>                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">Tier</label>   
                                                            <input type="text"  id="tier" class="form-control"  name="bay_tier"  disabled>                                               
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Op Lapangan</label>   
                                                <input type="text"  id="user" class="form-control" value="{{ Auth::user()->name }}" name="wharf_yard_oa"  readonly>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i><span class="d-none d-sm-block">Close</span></button>
                            <button type="submit" class="btn btn-success ml-1 update_status"><i class="bx bx-check d-block d-sm-none"></i><span class="d-none d-sm-block">Confirm</span></button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('custom_js')
<script src="{{ asset('vendor/components/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('dist/assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>    
<script src="{{asset('dist/assets/js/pages/sweetalert2.js')}}"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.container').select2({
        dropdownParent:'#success',
    });
});
$(document).on('click', '.update_status', function(e){
    e.preventDefault();
    var container_key = $('#key').val();
    var container_no= $('#container_no').val();
    var data = {
       'container_key' : $('#key').val(),
       'container_no': $('#container_no').val(),
       'cc_tt_oper': $('#operator').val(),
       'cc_tt_no': $('#no_alat').val(),
       'wharf_yard_oa': $('#user').val(),
        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
                      Swal.fire({
                      title: 'Are you Sure?',
                      text: "Container " +container_no+ " will be updated",
                      icon: 'warning',
                      showDenyButton: false,
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Confirm',
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                       
                        $.ajax({
                            type: 'POST',
                            url: '/confirm',
                            data: data,
                            cache: false,
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                

                            },
                            error: function(data) {
                                    console.log('error:', data);
                                },
                        });
                        location.reload();
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')                     
                      }
                      
                      
                    })
   
});


$(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#container_no').on('change', function() {
                let id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/get-container-key',
                    data: { container_no : id },
                    success: function(response) {
                       
                            $('#key').val(response.key);
                            $('#name').val(response.name);
                            $('#slot').val(response.slot);
                            $('#row').val(response.row);
                            $('#tier').val(response.tier);
                        
                    },
                    error: function(data) {
                        console.log('error:', data);
                    },
                });
            });
    });
});

</script>

@endsection