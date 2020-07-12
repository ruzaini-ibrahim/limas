@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Book Checkout</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-hover" id="dataTableLender" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Current Lending</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Current Lending</th>
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
          <h3 class="panel-title">Checkout List</h3>
        </div>
        <div class="panel-body">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="name">ISBN Number</label>
                          <span class="form-required">*</span>
                          <input type="text" class="form-control filter" name="filter_isbn" id="filter_isbn" value="test123">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
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
                        <th>Return Date</th>
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
  </div>
</div>

<div class="modal fade" id="addCheckout" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="checkoutAdd" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Checkout Book</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
            @include('checkout.form._add')
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

    applySelect2('addCheckout');

    ajaxBookItem('#addCheckout');

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
          {
              text : '<i class="icon fa fa-plus"></i> Checkout',
              className : 'btn btn-outline-main btn-sm btnAdd',
              action: function ( e, dt, node, config ) {
                  //This will send the page to the location specified
                  // window.location.href = "{{ route('book.create') }}";
                  $('.btnAdd')
                    .attr('data-toggle', 'modal')
                    .attr('data-target', '#addCheckout');
              }
          },
      ],
      select: true,
      ajax: {
              url: '{{ url("admin/checkout/recordsLender") }}',
            } 
    });


    var table = $('#dataTable').DataTable({
      "processing": true,
      "serverSide": false,
      // "searching": false,
      // "pageLength": 25,
      "dom": '<"row my-2"<"col-md-12 text-md-right text-center"B>><"row my-2"<"col-md-6"l><"col-md-6"f>r><t>ip',
      "order": [[ 0, "desc" ]],
      'columnDefs': [ {
        'targets': [9], /* column index */
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
          {
              text : '<i class="icon fa fa-plus"></i> Checkout',
              className : 'btn btn-outline-main btn-sm btnAdd',
              action: function ( e, dt, node, config ) {
                  //This will send the page to the location specified
                  // window.location.href = "{{ route('book.create') }}";
                  $('.btnAdd')
                    .attr('data-toggle', 'modal')
                    .attr('data-target', '#addCheckout');
              }
          },
      ],
      select: true,
      ajax: {
              url: '{{ url("admin/checkout/records") }}',
              data: function(data){
                data.isbn = $('#filter_isbn').val();
              }
            } 
    });

    

    $('.filter').on("keyup",function (){
      console.log($('#filter_isbn').val());
      table
        .search( $(this).val() )
        .draw();
    });

    $('#checkoutAdd').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/checkout") }}',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#addCheckout').modal('hide');
          $('#checkoutAdd')[0].reset();
          $('#dataTableLender').DataTable().ajax.reload();

        }else{
          showToastr('Unsuccessful', response.message, 'warning');
        }
      });
    });

    $('#bookEdit').on('submit', function(e) {
      e.preventDefault();
      var id = $('#editBook input[name=id]').val();
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/checkout") }}/' + id,
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

function addCheckout(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/checkout") }}/'+id+'/showCreateModal',
  }).done(function(response) {
    $('#addCheckout').modal('show');
    $('#addCheckout .modal-body').html(response);
    applySelect2('addCheckout');
    ajaxBookItem('#addCheckout');
    applyDatepicker('.datepicker');
  });
}

function deleteBook(id) {
  if(confirm('Are you want to delete this data?')){
    $.ajax({
      method: 'post',
      url: '{{ url("admin/checkout") }}/'+id,
      data: '_token='+csrf_token+'&_method=DELETE',
    }).done(function(response) {
      showToastr('Success', response.message, 'success');
      $('#dataTable').DataTable().ajax.reload();
    });    
  }
}

function ajaxBookItem(modal) {
  $(modal + ' #isbn').on('change',function (){
      if ($(this).val() != "") {
        $.ajax({
            type: "POST",
            url: '{{ url("admin/checkout/getBookItem") }}',
            data: {
                    bookItemId: $(this).val()
                  },
            success: function (data) {
              console.log( data.book.title);
                if (data.status) {
                  var title = data.book.title;
                  var publisher = data.book.publisher;
                  $('#title').val(title);
                  $('#publisher').val(publisher);
                  $('#refNo').empty().append('<option value="">Select Option</option>');

                  if (data.bookItems.length) {
                    $('#refNo').next().text('');
                    $.each(data.bookItems, function (key, value) {
                        $("#refNo").append($('<option>', {
                            value: value.id,
                            text: value.refNo,
                            'data-mark': value.id
                        }));
                    });                    
                  } else {
                    $('#refNo').next().text('No book is registered!');
                  }
                } else {
                    $('#refNo').next().text(data.message);
                    $('#refNo').empty().append('<option value="">Select Option</option>');
                }
            }
        });
      }else{
        $('#refNo').next().text('Please enter book isbn first');
        $('#refNo').empty();
        $('#title').val('');
      }
    });
}
</script>

@endsection