@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-line" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true"><i class="icon fas fa-info"></i> Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false"><i class="icon far fa-images"></i> Images</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="record-tab" data-toggle="tab" href="#record" role="tab" aria-controls="record" aria-selected="false"><i class="icon far fa-list-alt"></i> Records</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('book.index') }}"><i class="icon fas fa-backspace"></i> Back</a>
          </li>
        </ul>
        <div class="tab-content custom-tab my-4" id="myTabContent">
          <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title text-center">Book Details</h3>
              </div>
              <div class="panel-body">
                @include('book.show.detail')
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title text-center">Book Images</h3>
              </div>
              <div class="panel-body">
                @include('book.show.test')
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="record" role="tabpanel" aria-labelledby="record-tab">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title text-center">{{ $book->title }}</h3>
              </div>
              <div class="panel-body">
                @include('book.show.record')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
$('document').ready( function(){
  
  $('[data-toggle="lightbox"]').on('click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true,
    });
  });
});

 function showRecords(id) {
  $.ajax({
    method: 'get',
    url: '{{ url("admin/book") }}/'+id+'/book-item',
  }).done(function(response) {
    $('#showRecords').modal('show');
    $('#showRecords .modal-body').html(response);

    $('.see-more').on('click',function (){
      var div = $($(this).attr('data-div'));
      var url = $(this).attr('data-link');
      var page = $(this).attr('data-page');
      var full_url = url + page;
      $.ajax({
        method: 'get',
        url: full_url,
      }).done(function(response) {
        var new_data = $(response).find('#user_records').html();
        var count_data = $(response).find('#user_records tr');
        if(count_data.length == 0){
          $('a.see-more').css('display', 'none');
        }else{
          div.append(new_data);
        }
      });   
      $(this).attr('data-page', parseInt(page) + 1);
    });

  });
}

function showMore() {
  // var div = $(this).attr('data-div');
  // var url = $(this).attr('data-link');
  // var page = $(this).attr('data-page');
  // var full_url = url + page;
  console.log(this);
  // console.log(full_url);
}

</script>
@endsection

