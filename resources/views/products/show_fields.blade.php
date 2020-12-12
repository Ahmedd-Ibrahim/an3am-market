<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $product->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Image Field -->
{!! Form::label('image', 'Image:') !!}
<div class="form-group">

    <img src="{{asset('images/'.$product->image)}}" alt="">

</div>
<!-- Desc Field -->
<div class="form-group">
    {!! Form::label('desc', 'Desc:') !!}
    <p>{{ $product->desc }}</p>
</div>

<!-- Desc Field -->
<div class="form-group">
    {!! Form::label('age', 'Age:') !!}
    <p>{{ $product->age }}</p>
</div>

<!-- Sale Price Field -->
<div class="form-group">
    {!! Form::label('sale_price', 'Sale Price:') !!}
    <p>{{ $product->sale_price }}</p>
</div>

<!-- Featuter Field -->
<div class="form-group">
    {!! Form::label('featuter', 'Featuter:') !!}
    <p>{{ $product->featuter }}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $product->stock }}</p>
</div>

<!-- Regular Price Field -->
<div class="form-group">
    {!! Form::label('regular_price', 'Regular Price:') !!}
    <p>{{ $product->regular_price }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $product->user_id }}</p>
</div>

<!-- Type Id Field -->
<div class="form-group">
    {!! Form::label('type_id', 'Type Id:') !!}
    <p>{{ $product->type_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $product->updated_at }}</p>
</div>

