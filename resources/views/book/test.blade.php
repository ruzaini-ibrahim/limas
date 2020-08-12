@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 " id="test_a">
      @foreach($books as $book)
        <li class="list-unstyled">{{ $book->title }}</li>
      @endforeach      
    </div>
  </div>
  <button class="btn btn-main see-more" data-page="2" data-link="{{ url()->current() . '?page=' }}" data-div="#test_a">See more</button> 
<div class="float-right" style="margin-top: 20px;">  
      {{ $books->links() }}
  </div>
</div>


@endsection

@section('scripts')
<script>
$('document').ready( function(){
  $('.see-more').on('click',function (){
    var div = $($(this).attr('data-div'));
    var url = $(this).attr('data-link');
    var page = $(this).attr('data-page');
    var full_url = url + page;
    $.get(full_url, function (response){
      var new_data = $(response).find('#test_a').html();
      var count_data = $(response).find('#test_a li');
      if(count_data.length == 0){
        $('button.see-more').attr('disabled', true);
      }else{
        div.append(new_data);
      }
      // console.log(count_data.length);
    });
    $(this).attr('data-page', parseInt(page) + 1);
  });
});
</script>

@endsection