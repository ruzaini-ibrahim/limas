<div class="row justify-content-center">
  <div class="col-md-8 book-media">
    <div class="row">
      @foreach($bookMedias as $bookMedia)
      <a href="{{ $bookMedia['file_url'] }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-3 my-4">
        <img src="{{ $bookMedia['file_url'] }}" class="img-fluid">
        <div class="overlay">
		      <i class="zoom fas fa-search-plus"></i>
    		</div>
      </a>
      @endforeach()
    </div>
  </div>
</div>
