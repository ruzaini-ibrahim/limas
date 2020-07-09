<div class="row">
  <div class="col-md-12 @error('isbn') has-danger @enderror">
      <div class="form-group">
          <label for="name">ISBN Number</label>
          <span class="form-required">*</span>
          <input type="text" class="form-control" name="isbn" id="isbn" value="{{ isset($book) ? $book['isbn'] : '' }}">
          @error('isbn')
            <div class="alert text-danger">{{ $message }}</div>
          @enderror
      </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12 @error('title') has-danger @enderror">
        <div class="form-group">
            <label for="name">Title</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="title" id="title" value="{{ isset($book) ? $book['title'] : '' }}">
            @error('title')
            <div class="alert text-danger">{{ $message }}</div>
          @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 @error('publisher') has-danger @enderror">
        <div class="form-group">
            <label for="name">Publisher</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="publisher" id="publisher" value="{{ isset($book) ? $book['publisher'] : '' }}">
            @error('publisher')
            <div class="alert text-danger">{{ $message }}</div>
          @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 @error('category_id') has-danger @enderror">
        <div class="form-group">
          <label for="category_id">Category</label>
          <select class="form-control" id="category_id" name="category_id">
          <option value="">Please Choose one</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
          @endforeach
          </select>
          @error('category_id')
              <div class="alert text-danger">{{ $message }}</div>
          @enderror
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 @error('type') has-danger @enderror">
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" id="type" name="type">
          <option value="1" {{ isset($book) && $book->type == '1' ? 'selected' : '' }}>Fiction</option>
          <option value="0" {{ isset($book) && $book->type == '0' ? 'selected' : '' }}>Non-Fiction</option>
          </select>
          @error('type')
              <div class="alert text-danger">{{ $message }}</div>
          @enderror
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 @error('status') has-danger @enderror">
        <div class="form-group">
          <label for="Status">Status</label>
          <select class="form-control" id="Status" name="status">
          <option value="available" {{ isset($book) && $book->status == 'available' ? 'selected' : '' }}>Available</option>
          <option value="not available" {{ isset($book) && $book->status == 'not available' ? 'selected' : '' }}>Not Available</option>
          <option value="reserved" {{ isset($book) && $book->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
          <option value="missing" {{ isset($book) && $book->status == 'missing' ? 'selected' : '' }}>Missing</option>
          </select>
          @error('status')
              <div class="alert text-danger">{{ $message }}</div>
          @enderror
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 @error('book_total') has-danger @enderror">
        <div class="form-group">
            <label for="book_total">No of Books</label>
            <span class="form-required">*</span>
            <div class="input-group">
                <input type="number" class="form-control" name="book_total" id="book_total" value="{{ isset($book) ? $book->bookItem()->count() : '' }}" {{ isset($book) ? 'readonly' : '' }}>
                @isset($book)
                <span class="input-group-btn">
                  <button type="button" class="btn btn-main">Edit</button>
                </span>
                @endisset
            </div>
            @error('book_total')
            <div class="alert text-danger">{{ $message }}</div>
          @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Book Images</label>
            <span class="form-required">*</span>
            <div class="input-group">
              <div class="container-fluid">
                <div class="dropzone dz-clickable" id="myDrop" style="min-height: 150px;">
                    <div class="dz-default dz-message" data-dz-message="">
                        <span>Drop files here to upload <i class="icon md-upload" aria-hidden="true"></i></span>
                    </div>
                    @isset($bookMedias)
                    @foreach($bookMedias as $index => $image)
                    <div class="dz-preview dz-image-preview">
                      <div class="dz-image">
                        <img data-dz-thumbnail class="dz-image" src="{{ $image->file_url }}" alt="{{ $image->file_url }}" />
                      </div>
                      <div class="dz-details">
                        <div class="dz-size" data-dz-size>
                          <span data-dz-size="">
                            <strong>0.6</strong> MB
                          </span>
                        </div>
                        <div class="dz-filename">
                          <span data-dz-name><span data-dz-name="">{{ $image->file_name }}</span></span>
                        </div>
                      </div>
                      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                      <div class="dz-error-message"><span data-dz-errormessage></span></div>
                      <div class="dz-success-mark"><span>✔</span></div>
                      <div class="dz-error-mark"><span>✘</span></div>
                      <a class="dz-remove" href="javascript:undefined;">Remove file</a>
                      <input type="hidden" class="old_img" name="old_img"  value="{{ $image->file_name }}">
                    </div>
                    @endforeach
                    @endisset
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


@isset($book)
  <input type="hidden" name="id" id="book_id" value="{{ isset($book['id']) ? $book['id'] : '' }}">
@endisset

{{-- <div class="row">
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
</div> --}}

{{-- <div class="row">
    <div class="col-md-12">
      <input type="file" class="dropify" data-height="300" id="id_member_photo" name="n_member_photo" data-default-file="http://limas.test/storage/book_cover/20200702$2y$10$.Q8NHyF1qSIBwG9nm78pJeODmUSJYWMblPza432Ootp747mpPq.f..png"/>
    </div>
</div> --}}