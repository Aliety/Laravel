@if (Session::has('msg'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
            <i class="fa fa-check-circle fa-lg fa-fw"></i> MSG.
        </strong>
        {{ Session::get('msg') }}
    </div>
@endif