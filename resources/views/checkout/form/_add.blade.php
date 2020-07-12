<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lender_name">Lender Name</label>
            <input type="text" class="form-control" name="lender_name" id="lender_name" value="{{ isset($user) ? $user['name'] : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lender_email">Lender Email</label>
            <input type="text" class="form-control" name="lender_email" id="lender_email" value="{{ isset($user) ? $user['email'] : '' }}" readonly>
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
            <input type="text" class="form-control" name="title" id="title" value="{{ isset($bookCheckout) ? $bookCheckout['title'] : '' }}" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher" value="{{ isset($bookCheckout) ? $bookCheckout['title'] : '' }}" readonly>
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

<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="borrowed_date">Date Lend & Due Date</label>
        <div class="input-group">
          <span class="input-group-addon">
            From
          </span>
          <input type="text" class="form-control datepicker" id="borrowed_date" name="borrowed_date" autocomplete="off">
          <span class="input-group-addon">
            To
          </span>
          <input type="text" class="form-control datepicker" id="due_date" name="due_date" autocomplete="off">
        </div>
      </div>
    </div>
</div>


@isset($user)
    <input type="hidden" name="id" value="{{ isset($user['id']) ? $user['id'] : '' }}">
@endisset