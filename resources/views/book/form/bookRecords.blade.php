<div class="table-responsive">
  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Borrow At</th>
        <th>Return At</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Borrow At</th>
        <th>Return At</th>
      </tr>
    </tfoot>
    <tbody id="user_records">
      @foreach($bookCheckouts as $bookCheckout)
      <tr>
        <td>{{ $bookCheckout->id }}</td>
        <td>{{ $bookCheckout->lender->name }}</td>
        <td>{{ $bookCheckout->status }}</td>
        <td>{{ $bookCheckout->borrowed_date }}</td>
        <td>{{ $bookCheckout->return_date }}</td>
      </tr>
      @endforeach()
    </tbody>
  </table>
</div>
<a class="see-more color-main" href="javascript:void(0)" data-page="2" data-link="{{ url()->current() . '?page=' }}" data-div="#user_records">See more</a>