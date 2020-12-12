<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', 'Lat:') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lang', 'Lang:') !!}
    {!! Form::text('lang', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street', 'street:') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('governorate', 'governorate:') !!}
    {!! Form::text('governorate', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'city:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('building_number', 'building_number:') !!}
    {!! Form::text('building_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('floor_number', 'floor_number:') !!}
    {!! Form::text('floor_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flat_number', 'flat_number:') !!}
    {!! Form::text('flat_number', null, ['class' => 'form-control']) !!}
</div>
<!-- Lang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flag', 'flag:') !!}
    {!! Form::text('flag', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', \App\Models\User::pluck('name','id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('addresses.index') }}" class="btn btn-default">Cancel</a>
</div>
