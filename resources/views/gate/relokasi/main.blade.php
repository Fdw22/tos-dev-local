@extends('partial.main')
@section('custom_styles')
<style>
  .border {
    border: 1px solid transparent;
    /* Set border dulu ke transparan */
    border-image: linear-gradient(to right, rgba(128, 128, 128, 0.5), transparent);
    /* Gunakan linear gradient untuk border dengan gradasi */
    border-image-slice: 1;
    /* Memastikan border image mencakup seluruh border */
  }
</style>
@endsection

@section('content')
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Gate Relokasi</h3>
      </div>

      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Gate MT & Relokasi Pelindo</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <section>
    <div class="card">
      <div class="card-header">
        <h6>Masukkan Data dengan Benar!!</h6>
        <div>
          <span>Data akan diproses secara otomatis pada tahap selanjutnya</span>
        </div>
        <hr style="border:1px solid red;">
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <h6>Nomor Truck</h6>
          </div>
          <div class="col-1">
            :
          </div>
          <div class="col-6">
            <input type="text" class="form-control" id="truck" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-4">
            <h6>Container</h6>
          </div>
          <div class="col-1">
            :
          </div>
          <div class="col-6">
            <select class="choices form-control" name="container_key" id="container">
              <option value="" disabled values selected>Select Container</option>
              <?php
              foreach ($jobContainers->containers as $value) { ?>
                <?php if (($value->jobContainer->ctr_intern_status == "11") || ($value->jobContainer->ctr_intern_status == "15" && $value->jobContainer->billingName == "DS")) { ?>
                  <option value="<?= $value->jobContainer->container_key ?>"><?= $value->jobContainer->container_no ?></option>
                <?php } ?>
              <?php } ?>

            </select>

          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-4">
            <h6>Invoice</h6>
          </div>
          <div class="col-1">
            :
          </div>
          <div class="col-3">
            <label for="">Invoice No</label>
            <input type="text" class="form-control" id="invoice">
          </div>
          <div class="col-3">
            <label for="">Job No</label>
            <input type="text" class="form-control" id="job">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-4">
            <h6>Dokumen BC</h6>
          </div>
          <div class="col-1">
            :
          </div>
          <div class="col-3">
            <label for="">Order Service</label>
            <input type="text" class="form-control" id="orderservice" required>
            <input type="hidden" class="form-control" id="orderserviceCode">
          </div>
          <div class="col-3">
            <label for="">Dok BC</label>
            <input type="text" class="form-control" id="dok">
            <input type="hidden" class="form-control" id="jenisDok">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-outline-primary ml-1 permit"><i class="bx bx-check d-block d-sm-none"></i><span class="d-none d-sm-block">Permit</span>
          </button>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header">
        <h4>Waiting to Out</h4>
      </div>
      <div class="card-body">
        <table class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>Container No</th>
              <th>Order Service</th>
            </tr>
          </thead>
          <tbody>
            @foreach($item_confirmed as $itm)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$itm->container_no}}</td>
              <td>
                @if($itm->order_service === 'sp2iks')
                SP2 Kapal Sandar Icon (MT Balik IKS / MKB)
                @endif
                @if($itm->order_service === 'sp2icon')
                SP2 Relokasi Pelindo
                @endif
                @if($itm->order_service === 'sppsrelokasipelindo')
                SPPS (Relokasi Pelindo - ICON)
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
  @endsection

  @section('custom_js')
  <script src="{{ asset('vendor/components/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{asset('dist/assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="{{asset('dist/assets/js/pages/sweetalert2.js')}}"></script>
  <script>
    $(document).on('click', '.permit', function(e) {
      e.preventDefault();
      var container_key = $('#container').val();
      var data = {
        'container_key': $('#container').val(),
        'order_service': $('#orderserviceCode').val(),
        'job_no': $('#job').val(),
        'invoice_no': $('#invoice').val(),
        'jenis_dok': $('#dok').val(),
        'no_dok': $('#jenisDok').val(),
        'truck_no': $('#truck').val(),





      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      Swal.fire({
        title: 'Are you Sure?',
        text: " ",
        icon: 'warning',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirm',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

          $.ajax({
            type: 'POST',
            url: '/gate-relokasi',
            data: data,
            cache: false,
            dataType: 'json',
            success: function(response) {
              console.log(response);
              if (response.success) {
                Swal.fire('Saved!', 'Silahkan Menuju Bagian Placement', 'success')
                  .then(() => {
                    // Memuat ulang halaman setelah berhasil menyimpan data
                    window.location.reload();
                  });
              } else {
                Swal.fire('Error', response.message, 'error');
              }

            },
            error: function(response) {
              var errors = response.responseJSON.errors;
              if (errors) {
                var errorMessage = '';
                $.each(errors, function(key, value) {
                  errorMessage += value[0] + '<br>';
                });
                Swal.fire({
                  icon: 'error',
                  title: 'Validation Error',
                  html: errorMessage,
                });
              } else {
                console.log('error:', response);
              }
            },
          });

        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }


      })

    });
  </script>

  <script>
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(document).ready(function() {
        $('#container').on('change', function() {
          let id = $(this).val();
          $.ajax({
            type: 'POST',
            url: '/relokasi-data_container',
            data: {
              container_key: id
            },
            success: function(response) {
              let res = JSON.parse(response);
              let job = res.data.containers[0].findContainer;
              let delivery = res.data.containers[0].deliveryForm;
              // console.log(res);
              $('#job').val(job.jobNumber);
              $('#invoice').val(job.invoiceNumber);
              $('#orderserviceCode').val(job.orderService);
              $('#orderservice').val(job.orderService);

              if (job.orderService === "sp2iks") {
                $('#orderservice').val("SP2 Kapal Sandar Icon (MT Balik IKS)");
              } else if (job.orderService === "sp2mkb") {
                $('#orderservice').val("SP2 Kapal Sandar icon (MKB)");
              } else if (job.orderService === "sp2pelindo") {
                $('#orderservice').val("SP2 Kapal Sandar Icon (MT Balik Pelindo)");
              } else if (job.orderService === "spps") {
                $('#orderservice').val("SPPS");
              } else if (job.orderService === "sppsrelokasipelindo") {
                $('#orderservice').val("SPPS (Relokasi Pelindo - ICON)");
              } else if (job.orderService === "sp2icon") {
                $('#orderservice').val("SP2 (Relokasi Pelindo - Icon)");
              }
              $('#dok').val(delivery.documentNumber);
              $('#jenisDok').val(delivery.documentType);
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