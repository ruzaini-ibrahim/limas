<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="name" id="code" value="{{ isset($user) ? $user['name'] : '' }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email</label>
            <span class="form-required">*</span>
            <input type="text" class="form-control" name="email" id="email" value="{{ isset($user) ? $user['email'] : '' }}">
        </div>
    </div>
</div>

@empty($user)
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="password">Password</label>
            <span class="form-required">*</span>
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>
</div>
@endempty


@isset($user)
    <input type="hidden" name="id" value="{{ isset($user['id']) ? $user['id'] : '' }}">
@endisset