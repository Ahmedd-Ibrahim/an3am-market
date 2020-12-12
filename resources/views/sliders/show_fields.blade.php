<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $slider->id }}</p>
</div>


<!-- Image Field -->
{!! Form::label('image', 'Image:') !!}
<div class="form-group">

    <img src="{{asset('images/'.$slider->image)}}" alt="">

</div>
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $slider->title }}</p>
</div>

<!-- Range Field -->
<div class="form-group">
    {!! Form::label('range', 'Range:') !!}
    <p>{{ $slider->range }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $slider->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $slider->updated_at }}</p>
</div>

