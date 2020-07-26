@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Return Book</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-hover" id="dataTableLender" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Ref No</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrow By</th>
                        <th>Borrow At</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Ref No</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrow By</th>
                        <th>Borrow At</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Return List</h3>
        </div>
        <div class="panel-body">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTableReturn" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Ref No</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrow By</th>
                        <th>Borrow At</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Ref No</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrow By</th>
                        <th>Borrow At</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addReturn" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="returnAdd" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Returned Book</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-main" type="submit">Save</button>
          </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCheckout" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="checkoutedit" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Edit Returned Book</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-main" type="submit">Save</button>
          </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>


$('document').ready( function(){

    applyDatepicker('#borrowed_on');

    var tableLender = $('#dataTableLender').DataTable({
      "processing": true,
      "serverSide": false,
      // "searching": false,
      // "pageLength": 25,
      "dom": '<"row my-2"<"col-md-12 text-md-right text-center"B>><"row my-2"<"col-md-6"l><"col-md-6"f>r><t>ip',
      "order": [[ 0, "desc" ]],
      'columnDefs': [ {
        'targets': [4], /* column index */
        'orderable': false, /* true or false */
      }],
      buttons: [
          {
              extend: 'csvHtml5',
              footer: true,
              title: 'List of Checkout',
              text: '<i class="icon fa fa-file-csv"></i> CSV',
              className : 'btn btn-outline-main btn-sm',
              titleAttr: 'Export CSV',
              exportOptions: {
                rows: ':visible'
              }
          },
          {
              extend: 'print',
              footer: true,
              title: 'List of Checkout',
              text : '<i class="icon fa fa-print"></i> Print',
              className : 'btn btn-outline-main btn-sm',
              titleAttr: 'Print',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              exportOptions: {
                rows: ':visible'
              }
          },
      ],
      select: true,
      ajax: {
              url: '{{ url("admin/return/recordsLender") }}',
            } 
    });


    var table = $('#dataTableReturn').DataTable({
      "processing": true,
      "serverSide": false,
      // "searching": false,
      // "pageLength": 25,
      "dom": '<"row my-2"<"col-md-12 text-md-right text-center"B>><"row my-2"<"col-md-6"l><"col-md-6"f>r><t>ip',
      "order": [[ 0, "desc" ]],
      'columnDefs': [ {
      }],
      buttons: [
          {
              extend: 'csvHtml5',
              footer: true,
              title: 'List of Checkout',
              text: '<i class="icon fa fa-file-csv"></i> CSV',
              className : 'btn btn-outline-main btn-sm',
              titleAttr: 'Export CSV',
              exportOptions: {
                rows: ':visible'
              }
          },
          {
              extend: 'print',
              footer: true,
              title: 'List of Checkout',
              text : '<i class="icon fa fa-print"></i> Print',
              className : 'btn btn-outline-main btn-sm',
              titleAttr: 'Print',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              exportOptions: {
                rows: ':visible'
              }
          },
      ],
      select: true,
      ajax: {
              url: '{{ url("admin/return/recordsReturn") }}',
            } 
    });

    $('#returnAdd').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/return") }}',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#addReturn').modal('hide');
          $('#returnAdd')[0].reset();
          $('#dataTableLender, #dataTableReturn').DataTable().ajax.reload();

        }else{
          showToastr('Unsuccessful', response.message, 'warning');
        }
      });
    });

    $('#checkoutedit').on('submit', function(e) {
      e.preventDefault();
      var id = $('#editBook input[name=id]').val();
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/return") }}/' + id,
        data: $('#bookEdit').serialize(),
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#editBook').modal('hide');
          $('#bookEdit')[0].reset();
          $('#dataTable').DataTable().ajax.reload();

        }else{
          showToastr('Unsuccessful', response.message, 'warning');
        }
      });
    });

});

function addReturn(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/return") }}/'+id+'/showCreateModal',
  }).done(function(response) {
    $('#addReturn').modal('show');
    $('#addReturn .modal-body').html(response);
    applyDatepicker('.datepicker');
    $('#return_date').val(getCurrentDate());
  });
}

function editCheckout(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/return") }}/'+id+'/edit',
  }).done(function(response) {
    $('#addReturn').modal('show');
    $('#addReturn .modal-body').html(response);
    applySelect2('addReturn');
    ajaxBookItem('#addReturn');
    applyDatepicker('.datepicker');
  });
}

function deleteCheckout(id) {
  if(confirm('Are you want to delete this data?')){
    $.ajax({
      method: 'post',
      url: '{{ url("admin/return") }}/'+id,
      data: '_token='+csrf_token+'&_method=DELETE',
    }).done(function(response) {
      showToastr('Success', response.message, 'success');
      $('#dataTable').DataTable().ajax.reload();
    });    
  }
}

</script>

@endsection