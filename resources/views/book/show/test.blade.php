<ul class="custom-media-main">
  @foreach($bookMedias as $bookMedia)
  <a href="{{ $bookMedia['file_url'] }}" data-toggle="lightbox" data-gallery="example-gallery" class="custom-media-content">
    <img src="{{ $bookMedia['file_url'] }}" class="img-fluid">
    <div class="overlay">
      <i class="zoom fas fa-search-plus"></i>
    </div>
  </a>
  @endforeach()
</ul>