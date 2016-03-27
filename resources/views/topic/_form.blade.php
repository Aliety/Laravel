<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                Name
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" autofocus id="name" value="{{ $name }}">
            </div>
        </div>

        <div class="form-group">
            <label for="college" class="col-md-2 control-label">
                College
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="college" id="college" value="{{ $college }}">
            </div>
        </div>

        <div class="form-group">
            <label for="grade" class="col-md-2 control-label">
                Grade
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="grade" id="grade" value="{{ $grade }}">
            </div>
        </div>

        <div class="form-group">
            <label for="content" class="col-md-2 control-label">
                Content
            </label>
            <div class="col-md-10">
                <textarea class="form-control" name="content" id="content" rows="6">{{ $content }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="type" class="col-md-2 control-label">
                Type
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="type" id="type" value="{{ $type }}">
            </div>
        </div>

        <div class="form-group">
            <label for="place" class="col-md-2 control-label">
                Place
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="place" id="place" value="{{ $place }}">
            </div>
        </div>

        <div class="form-group">
            <label for="week" class="col-md-2 control-label">
                Week
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="week" id="week" value="{{ $week }}">
            </div>
        </div>

        <div class="form-group">
            <label for="number" class="col-md-2 control-label">
                Number
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="number" id="number" value="{{ $number }}">
            </div>
        </div>

        <div class="form-group">
            <label for="level" class="col-md-2 control-label">
                Level
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="level" id="number" value="{{ $level }}">
            </div>
        </div>

        <div class="form-group">
            <label for="requirement" class="col-md-2 control-label">
                Requirement
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="requirement" id="requirement" value="{{ $requirement }}">
            </div>
        </div>

        <div class="form-group">
            <label for="profile" class="col-md-2 control-label">
                Profile
            </label>
            <div class="col-md-10">
                <textarea class="form-control" name="profile" id="profile" rows="6">{{ $profile }}</textarea>
            </div>
        </div>
    </div>
</div>