<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="isbn">Book ISBN</label>
            <span class="form-required">*</span>
            <select class="form-control select2" id="isbn" name="isbn" style="width: 100%">
              <option value="">Please Choose one</option>
              @foreach($books as $book)
                <option value="{{ $book->id }}" {{ isset($bookCheckout) && $bookCheckout->category_id == $bookCheckout->id ? 'selected' : '' }}>{{ $book->isbn }}</option>
              @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Title</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="title" id="title" value="{{ isset($bookCheckout) ? $bookCheckout['title'] : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
          <label for="refNo">Book Reference No</label>
          <select class="form-control" id="refNo" name="refNo">
            <option value="">Please Choose</option>
          </select>
          <div class="text-danger">Please enter book isbn first</div>
      </div>
    </div>
</div>

@isset($category)
    <input type="hidden" name="id" value="{{ isset($category['id']) ? $category['id'] : '' }}">
@endisset