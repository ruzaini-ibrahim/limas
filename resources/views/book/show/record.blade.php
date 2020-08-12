<div class="table-responsive">
  <table class="table table-hovered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ref No</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Ref No</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach($bookItems as $bookItem)
      <tr>
        <td>{{ $bookItem->id }}</td>
        <td>{{ $bookItem->refNo }}</td>
        <td>{{ $bookItem->status }}</td>
        <td><a onclick="showRecords({{ $bookItem->id }})" href="javascript:void(0)" class="mx-1"><i class="fa fa-eye color-main"></i></a></td>
      </tr>
      @endforeach()
    </tbody>
  </table>
</div>


<div class="modal fade" id="showRecords" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form id="checkoutedit" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header bg-purple-400">
              <h5 class="modal-title purple-50" id="modalLabel">Book Records</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-main" type="submit">Save</button>
          </div>
        </form>
        </div>
    </div>
</div>
