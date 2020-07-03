@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                    CATEGORY
                    <button class="btn btn-main float-right" href="javascript:void(0)" data-toggle="modal" data-target="#addCategory" id="addButton">Add Category</button>
                </div>
                <div class="card-block">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
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

<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="categoryAdd" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Add Category</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
            @include('category.form._add')
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-main" type="submit">Save</button>
          </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="categoryEdit" enctype="multipart/form-data">
          @method('put')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Edit Category</h5>
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
  var pdfbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/pdf.png") }}"' + ' alt="pdf" />';
  var excelbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/excel.png") }}"' + ' alt="excel" />';
  var csvbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/csv.png") }}"' + ' alt="csv" />';
  var printbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/print.png") }}"' + ' alt="print" />';
$('document').ready( function(){
    var table = $('#dataTable').DataTable({
      "processing": true,
      "serverSide": false,
      // "searching": false,
      // "pageLength": 25,
      "dom": '<"row my-2"<"col-md-12 text-md-right text-center"B>><"row my-2"<"col-md-6"l><"col-md-6"f>r><t>ip',
      "order": [[ 0, "desc" ]],
      'columnDefs': [ {
        'targets': [2], /* column index */
        'orderable': false, /* true or false */
      }],
      buttons: [
          {
              extend : 'excelHtml5',
              footer: true,
              title: 'Category',
              text : excelbutton,
              className : 'btn btn-default btn-xs',
              titleAttr: 'Export Excel',
              exportOptions: {
                rows: ':visible'
              }
          },
          {
              extend: 'pdfHtml5',
              footer: true,
              title: 'Category',
              text: pdfbutton,
              className : 'btn btn-default btn-xs',
              titleAttr: 'Export PDF',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              customize: function (doc) { doc.defaultStyle.fontSize = 8;},
              exportOptions: {
                rows: ':visible'
              }
          },
          {
              extend: 'csvHtml5',
              footer: true,
              title: 'Category',
              text: '<i class="fa fa-file-csv"></i> CSV',
              className : 'btn btn-outline-main btn-sm',
              titleAttr: 'Export CSV',
              exportOptions: {
                rows: ':visible'
              }
          },
          {
              extend: 'print',
              footer: true,
              title: 'Category',
              text : '<i class="fa fa-print"></i> Print',
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
      "ajax": '{{ url("admin/category/records") }}'
    });

    $('#categoryAdd').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/category") }}',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#addCategory').modal('hide');
          $('#categoryAdd')[0].reset();
          $('#dataTable').DataTable().ajax.reload();

        }else{
          showToastr('Unsuccessful', response.message, 'warning');
        }
      });
    });

    $('#categoryEdit').on('submit', function(e) {
      e.preventDefault();
      var id = $('#editCategory input[name=id]').val();
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/category") }}/' + id,
        data: $('#categoryEdit').serialize(),
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#editCategory').modal('hide');
          $('#categoryEdit')[0].reset();
          $('#dataTable').DataTable().ajax.reload();

        }else{
          showToastr('Unsuccessful', response.message, 'warning');
        }
      });
    });

});

function editCategory(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/category") }}/'+id+'/edit',
  }).done(function(response) {
    $('#editCategory').modal('show');
    $('#editCategory .modal-body').html(response);
  });
}

function deleteCategory(id) {
  if(confirm('Are you want to delete this data?')){
    $.ajax({
      method: 'post',
      url: '{{ url("admin/category") }}/'+id,
      data: '_token='+csrf_token+'&_method=DELETE',
    }).done(function(response) {
      showToastr('Success', response.message, 'success');
      $('#dataTable').DataTable().ajax.reload();
    });    
  }
}
</script>

@endsection