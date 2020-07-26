<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4 class="my-4">Payment List:</h4>
      <div class="panel">
        @isset($group_data)
          @foreach($group_data as $data)
            <div class="panel-body shadow">
              <h4 class="my-4">{{ $data['name'] }}</h4>
            @isset($data['data'])
              @foreach($data['data'] as $fine)
              <input type="hidden" name="fines_id[]" value="{{ $fine->id }}">
              <div class="row my-4">
                <div class="col-sm-6">
                  <div> Title: {{ $fine->bookItem->book_title }}</div>
                  <div> Ref No: {{ $fine->bookItem->refNo }}</div>
                </div>
                <div class="col-sm-6 align-self-end">
                  <div> Total: RM {{ calcFine($fine->return_date, $fine->due_date) }}</div>
                </div>
              </div>
              @endforeach
            @endisset
            </div>
          @endforeach
        @endisset
        <div class="panel-body">
          <h4 class="my-4">Payment Confirmation:</h4>
          <div class="row my-4">
            <div class="col-sm-6">
              <div> Total Books: {{ $total_book }}</div>
            </div>
            <div class="col-sm-6 align-self-end">
              <div> Total Payment: RM {{ number_format($total_payment, 2) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
