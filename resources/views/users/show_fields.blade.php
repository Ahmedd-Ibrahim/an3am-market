<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Verified Code Field -->
<div class="form-group">
    {!! Form::label('verified_code', 'Verified Code:') !!}
    <p>{{ $user->verified_code }}</p>
</div>

<!-- Password Field -->
{{--<div class="form-group">--}}
{{--    {!! Form::label('password', 'Password:') !!}--}}
{{--    <p>{{ $user->password }}</p>--}}
{{--</div>--}}

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <p>{{ $user->role }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $user->phone }}</p>
</div>

<!-- Phone Verified Field -->
<div class="form-group">
    {!! Form::label('phone_verified', 'Phone Verified:') !!}
    <p>{{ $user->phone_verified }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>
