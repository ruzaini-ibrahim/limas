@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Fine</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
          <a class="btn btn-main btn-sm float-right" href="javascript:void(0)" onclick="payFine()" data-toggle="modal" data-target="#addCategory" id="addButton"><i class="icon fa fa-plus"></i> Batch Payment</a>
        </div>
      </div>
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
                        <th>Due Date</th>
                        <th>Returned At</th>
                        <th>Totals</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th colspan="8" class="text-center font-weight-700"></th>
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
          <h3 class="panel-title">Paid List</h3>
        </div>
        <div class="panel-body">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTableFine" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Ref No</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrow By</th>
                        <th>Due Date</th>
                        <th>Returned At</th>
                        <th>Return Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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

<div class="modal fade" id="payFine" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="paymentAdd" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Payment Confirmation</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-main" type="submit">Confirm</button>
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
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // converting to interger to find total
        var intVal = function ( i ) {
          return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
                i : 0;
        };

         var Total = api
            .column( 7 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
        var str_total = Total.toString();
        var arr_total = str_total.split('.');
        var cent = "";
        if(arr_total[1] !== undefined)
        {
          if(arr_total[1] < 10 && arr_total[1].length == 1)
          {
            var cent = "0";
          }
        }
        else
        {
          var cent = ".00";
        }
        // Update footer by showing the total with the reference of the column index 
        $( api.column( 7 ).footer() ).html('Totals (RM) : ' + Total + cent);

        $( api.column( 8 ).footer() ).html('<div class="border-w-0 checkbox-custom checkbox-main"><input type="checkbox" name="selectAll" id="selectAll"><label for="selectAll">Select All</label></div>');

        $('input[type="checkbox"]#selectAll').click(function(){
              if($(this).is(":checked")){
                $('.checkbox-item').each(function (){
                  $(this).find('input[type="checkbox"]').removeAttr('checked');
                  $(this).find('input[type="checkbox"]').click();
                });
              }
              else if($(this).is(":not(:checked)")){
                  $('.checkbox-item').each(function (){
                    $(this).find('input[type="checkbox"]').removeAttr('checked');
                  });
              }
        });
      },
      buttons: [
          {
              extend: 'csvHtml5',
              footer: true,
              title: 'List of Fined',
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
              title: 'List of Fined',
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
              url: '{{ url("admin/fine/recordsLender") }}',
            } 
    });


    var table = $('#dataTableFine').DataTable({
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
              title: 'List of Fined',
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
              title: 'List of Fined',
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
                    .attr('data-target', '#payFine');
              }
          },
      ],
      select: true,
      ajax: {
              url: '{{ url("admin/fine/recordsFine") }}',
            } 
    });

    $('#paymentAdd').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
        method: 'POST',
        url: '{{ url("admin/fine") }}',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
      }).done(function(response) {
        if(response.status){
          showToastr('Success', response.message, 'success');
          $('#payFine').modal('hide');
          $('#paymentAdd')[0].reset();
          $('#dataTableLender, #dataTableFine').DataTable().ajax.reload();

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
        url: '{{ url("admin/fine") }}/' + id,
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

function payFine() {
  var batch_payment = [];
  $('.checkbox-item input[type="checkbox"]:checked').each(function (){
    batch_payment.push($(this).val());
  });
  $.ajax({
    method: 'get',
    url: '{{ url("admin/fine") }}/showPaymentModal',
    data: 'batch_payment=' + batch_payment,
  }).done(function(response) {
    $('#payFine').modal('show');
    $('#payFine .modal-body').html(response);
    var data = $('#payFine input[name="fines_id[]"]').length;
    if(!data)
    {
      $('#payFine button[type="submit"]').attr('disabled', true);
    }else{
      $('#payFine button[type="submit"]').removeAttr('disabled');
    }
  });
}

function editCheckout(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/fine") }}/'+id+'/edit',
  }).done(function(response) {
    $('#payFine').modal('show');
    $('#payFine .modal-body').html(response);
    applySelect2('payFine');
    ajaxBookItem('#payFine');
    applyDatepicker('.datepicker');
  });
}

function deleteCheckout(id) {
  if(confirm('Are you want to delete this data?')){
    $.ajax({
      method: 'post',
      url: '{{ url("admin/fine") }}/'+id,
      data: '_token='+csrf_token+'&_method=DELETE',
    }).done(function(response) {
      showToastr('Success', response.message, 'success');
      $('#dataTable').DataTable().ajax.reload();
    });    
  }
}

</script>

@endsection