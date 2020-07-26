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
            <input type="text" class="form-control" name="isbn" id="isbn" value="{{ isset($bookCheckout) ? $bookCheckout->bookItem->book->isbn : '' }}" readonly>
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
            <input type="text" class="form-control" name="refNo" id="refNo" value="{{ isset($bookCheckout) ? $bookCheckout->bookItem->refNo : '' }}" readonly>
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
          <input type="text" class="form-control datepicker" id="borrowed_date" name="borrowed_date" autocomplete="off" value="{{ isset($bookCheckout->borrowed_date) ? dateFormatDMY($bookCheckout->borrowed_date) : '' }}" readonly="">
          <span class="input-group-addon">
            To
          </span>
          <input type="text" class="form-control datepicker" id="due_date" name="due_date" autocomplete="off" value="{{ isset($bookCheckout->due_date) ? dateFormatDMY($bookCheckout->due_date) : ''}}" readonly="">
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="return_date">Returned Date</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="far fa-calendar-alt"></i>
          </span>
          <input type="text" class="form-control datepicker" id="return_date" name="return_date" autocomplete="off">
        </div>
      </div>
    </div>
</div>

@isset($bookCheckout)
  <input type="hidden" name="lender_id" value="{{ $bookCheckout->lender->id }}">
  <input type="hidden" name="checkout_id" value="{{ $bookCheckout->id }}">
@endisset