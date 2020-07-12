@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-4">
            <div class="card">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                    EDIT BOOKS
                    <a class="btn btn-main float-right" href="{{ route('book.index') }}" >Back</a>
                </div>
                <div class="card-block">
                  <form id="bookAdd" action="{{ route('book.update',['book' => $book['id']]) }}" enctype="multipart/form-data" method="POST">
                    @method('put')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      @include('book.form._add')

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
if($('input[name=id]').length){
}
  $('.dz-remove').on('click', function(){
    $(this).parent().remove()
  });

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
  $('#add_book').on('click', function(){
    if($('.dz-preview').length){
      if($('.dz-preview').length == $('.old_img').length){
        $('#bookAdd').submit();
      }else{
        myDropzone.processQueue();
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

  myDropzone.on("sending", function (file, xhr, formData) {
    var file_names = [];

    $('.dz-preview .dz-filename').each(function (){
      let name = $(this).find('span').text();
      file_names.push(name);
    });
    
    formData.append('file_names', file_names);

    if($('input[name=id]').length){
      formData.append('book_id', $('#book_id').val());
    }

  });
});

</script>

@endsection