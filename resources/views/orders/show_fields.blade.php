<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $order->id }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $order->price }}</p>
</div>

<!-- Serial Field -->
<div class="form-group">
    {!! Form::label('serial', 'Serial:') !!}
    <p>{{ $order->serial }}</p>
</div>

<!-- Delivery Price Field -->
<div class="form-group">
    {!! Form::label('delivery_price', 'Delivery Price:') !!}
    <p>{{ $order->delivery_price }}</p>
</div>

<!-- Total Price Field -->
<div class="form-group">
    {!! Form::label('total_price', 'Total Price:') !!}
    <p>{{ $order->total_price }}</p>
</div>

<!-- Process Field -->
<div class="form-group">
    {!! Form::label('process', 'Process:') !!}
    <p>{{ $order->process }}</p>
</div>

<!-- Deliveried Date Field -->
<div class="form-group">
    {!! Form::label('deliveried_date', 'Deliveried Date:') !!}
    <p>{{ $order->deliveried_date }}</p>
</div>

<!-- Address Id Field -->
<div class="form-group">
    {!! Form::label('address_id', 'Address Id:') !!}
    <p>{{ $order->address_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $order->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $order->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $order->updated_at }}</p>
</div>

