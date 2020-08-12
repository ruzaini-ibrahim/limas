@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-4">
            <div class="card">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                    ADD BOOKS
                    <a class="btn btn-main float-right" href="{{ route('book.index') }}" >Back</a>
                </div>
                <div class="card-block">
                  <form id="bookAdd" action="{{ route('book.store') }}" enctype="multipart/form-data" method="POST">
                    @method('post')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      @include('book.form._add')

                    @isset($book)
                      <input type="hidden" name="id" value="{{ isset($book['id']) ? $book['id'] : '' }}">
                    @endisset
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('book.index') }}">Discard</a>
                        {{-- <button class="btn btn-primary btn-sm" id="add_book_new" type="button">Save & New</button> --}}
                        <button class="btn btn-main btn-sm" id="add_book" type="button">Save</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$('document').ready( function(){
  // $('.dropify').dropify();

  var adminUrl = window.location.origin + '/admin';
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var myDropzone = new Dropzone("div#myDrop",
                    {
                      autoProcessQueue: false,
                      addRemoveLinks: true,
                      url: adminUrl + '/book/coverAdd',
                      paramName: "files",
                      uploadMultiple: true,
                      parallelUploads: 10,
                      maxFilesize: 8, // MB
                      acceptedFiles: ".png, .jpeg, .jpg, .gif",
                      headers: {
                        'x-csrf-token': CSRF_TOKEN,
                      },
                    });
  // $('#add_book').one('click', function(){
  $('#add_book').on('click', function(){
    console.log($('.dz-preview').length);
    var validate = formValidate();
    if($('.dz-preview').length > 0){
      if(validate == 0){
        myDropzone.processQueue();
      }else{
        showToastr('Unsuccessful!', 'Please fill in the required form!', 'warning');    
      }
    }else{
      $('#bookAdd').submit();
    }
  });

  myDropzone.on('success', function(file, response) {
    showToastr('Success!', 'Images upload successfully', 'success');
    $('#bookAdd').submit();
  });

  myDropzone.on('error', function(file, response) {
    showToastr('Failed!', 'Failed to upload images', 'warning');
    $('.dz-error-message').text('Failed to upload file. Please Try Again!');
  });
});

function formValidate()
{
  var error = 0;
  $('.form-group .req').each(function() {
    var form_group = $(this).parent();
    form_group.removeClass('has-danger');
    form_group.find('.alert.text-danger').remove();

    if($(this).val() == "")
    {
      error++;
      var label  = form_group.find('label').text();
      form_group.addClass('has-danger');
      form_group.append($('<div>', {
        'class': 'alert text-danger',
        text: label+' is required!'
      }));
    }
  });
  return error;
}
</script>

@endsection