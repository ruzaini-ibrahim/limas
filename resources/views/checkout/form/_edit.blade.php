<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lender_name">Lender Name</label>
            <input type="text" class="form-control" name="lender_name" id="lender_name" value="{{ isset($bookCheckout) ? $bookCheckout->lender->name : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lender_email">Lender Email</label>
            <input type="text" class="form-control" name="lender_email" id="lender_email" value="{{ isset($bookCheckout) ? $bookCheckout->lender->email : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="isbn">Book ISBN</label>
            <span class="form-required">*</span>
            <select class="form-control select2" id="isbn" name="isbn" style="width: 100%">
              <option value="">Please Choose one</option>
              @foreach($books as $book)
                <option value="{{ $book->id }}" {{ isset($bookCheckout) && $bookCheckout->bookItem->book_id == $book->id ? 'selected' : '' }}>{{ $book->isbn }}</option>
              @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ isset($bookCheckout) ? $bookCheckout->bookItem->book_title : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher" value="{{ isset($bookCheckout) ? $bookCheckout->bookItem->book_publisher : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
          <label for="refNo">Book Reference No</label>
          <select class="form-control select2" id="refNo" name="refNo" style="width: 100%">
            <option value="">Please Choose</option>
            @isset($bookItems)
              @foreach($bookItems as $item)
                <option value="{{ $item->id }}" {{ isset($bookCheckout) && $bookCheckout->bookItem->id == $item->id ? 'selected' : '' }}>{{ $item->refNo . " " . $item->status}}</option>
              @endforeach
            @endisset
          </select>
          <div class="text-danger">
          @empty($bookItems) 
            Please enter book isbn first 
          @endempty
          </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="borrowed_date">Date Lend & Due Date</label>
        <div class="input-group">
          <span class="input-group-addon">
            From
          </span>
          <input type="text" class="form-control datepicker" id="borrowed_date" name="borrowed_date" autocomplete="off" value="{{ dateFormatDMY($bookCheckout->borrowed_date) }}">
          <span class="input-group-addon">
            To
          </span>
          <input type="text" class="form-control datepicker" id="due_date" name="due_date" autocomplete="off" value="{{ dateFormatDMY($bookCheckout->due_date) }}">
        </div>
      </div>
    </div>
</div>


@isset($user)
    <input type="hidden" name="id" value="{{ isset($user['id']) ? $user['id'] : '' }}">
@endisset