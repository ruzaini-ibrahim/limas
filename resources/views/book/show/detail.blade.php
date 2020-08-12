<div class="row">
  <div class="col-md-12">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <div class="d-flex flex-row">
          <div class="book-details p-2">Title: </div>
          <div class="p-2">{{ $book->title }}</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">ISBN: </div>
          <div class="p-2">{{ $book->isbn }}</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">Publisher: </div>
          <div class="p-2">{{ $book->publisher }}</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">Catgegory: </div>
          <div class="p-2">Harry Potter and Prince of Azkaban</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">Type: </div>
          <div class="p-2">Harry Potter and Prince of Azkaban</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">Status: </div>
          <div class="p-2">{{ $book->status }}</div>
        </div>
        <div class="d-flex flex-row">
          <div class="book-details p-2">Total Books: </div>
          <div class="p-2">Harry Potter and Prince of Azkaban</div>
        </div>
      </div>
    </div>
  </div>
</div>