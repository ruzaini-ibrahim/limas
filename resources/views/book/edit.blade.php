@extends('layout.master')

@section('title','Book Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                    EDIT BOOKS
                    <a class="btn btn-main float-right" href="{{ route('book.index') }}" >Back</a>
                </div>
                <div class="card-block">
                  <form id="bookEdit" action="{{ url('admin/book/' . $book['id']) }}" enctype="multipart/form-data" method="POST">
                    @method('put')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">S

                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">ISBN Number</label>
                                <span class="form-required">*</span>
                                <input type="text" class="form-control" name="isbn" id="isbn" value="{{ isset($book) ? $book['isbn'] : '' }}">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="name">Title</label>
                                  <span class="form-required">*</span>
                                  <input type="text" class="form-control" name="title" id="title" value="{{ isset($book) ? $book['title'] : '' }}">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="name">Publisher</label>
                                  <span class="form-required">*</span>
                                  <input type="text" class="form-control" name="publisher" id="publisher" value="{{ isset($book) ? $book['publisher'] : '' }}">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                              <label for="category_id">Category</label>
                              <select class="form-control" id="category_id" name="category_id">
                              <option value="">Please Choose one</option>
                              @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                              @endforeach
                              </select>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                              <label for="type">Type</label>
                              <select class="form-control" id="type" name="type">
                              <option value="1" {{ isset($book) && $book->type == '1' ? 'selected' : '' }}>Fiction</option>
                              <option value="0" {{ isset($book) && $book->type == '0' ? 'selected' : '' }}>Non-Fiction</option>
                              </select>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                              <label for="Status">Status</label>
                              <select class="form-control" id="Status" name="status">
                              <option value="available" {{ isset($book) && $book->status == 'available' ? 'selected' : '' }}>Available</option>
                              <option value="not available" {{ isset($book) && $book->status == 'not available' ? 'selected' : '' }}>Not Available</option>
                              <option value="reserved" {{ isset($book) && $book->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                              <option value="missing" {{ isset($book) && $book->status == 'missing' ? 'selected' : '' }}>Missing</option>
                              </select>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="name">No of Books</label>
                                  <span class="form-required">*</span>
                                  <div class="input-group">
                                      <input type="number" class="form-control" name="book_total" id="book_total" value="{{ isset($book) ? $book->bookItem()->count() : '' }}" {{ isset($book) ? 'readonly' : '' }}>
                                      @isset($book)
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-main">Edit</button>
                                      </span>
                                      @endisset
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                            <div class="input-group input-group-file">
                              <input type="text" class="form-control" readonly="" placeholder="Upload File">
                              <span class="input-group-btn">
                                <span class="btn btn-main btn-file">
                                  <i class="icon md-upload" aria-hidden="true"></i>
                                  <input type="file" name="book_cover" id="book_cover">
                                </span>
                              </span>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                            <input type="file" class="dropify" data-height="300" id="id_member_photo" name="n_member_photo" data-default-file="http://limas.test/storage/book_cover/20200702$2y$10$.Q8NHyF1qSIBwG9nm78pJeODmUSJYWMblPza432Ootp747mpPq.f..png"/>
                          </div>
                      </div>

                @isset($book)
                    <input type="hidden" name="id" value="{{ isset($book['id']) ? $book['id'] : '' }}">
                @endisset
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-main" type="submit">Save</button>
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
  $('.dropify').dropify();
});
</script>

@endsection