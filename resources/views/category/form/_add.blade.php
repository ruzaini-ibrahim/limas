<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="name" id="code" value="{{ isset($category) ? $category['name'] : '' }}">
        </div>
    </div>
</div>


@isset($category)
    <input type="hidden" name="id" value="{{ isset($category['id']) ? $category['id'] : '' }}">
@endisset