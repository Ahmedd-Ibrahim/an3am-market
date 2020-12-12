<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

{{--<!-- Serial Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('serial', 'Serial:') !!}--}}
{{--    {!! Form::text('serial', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Delivery Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_price', 'Delivery Price:') !!}
    {!! Form::number('delivery_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_price', 'Total Price:') !!}
    {!! Form::number('total_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Process Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process', 'Process:') !!}
    {!! Form::select('process', ['prepare' => 'prepare','delivery'=>'delivery','done'=>'done'], null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_date', 'Delivery Date:') !!}
    {!! Form::text('delivery_date', null, ['class' => 'form-control','id'=>'delivery_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#delivery_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Address Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address_id', 'Address Id:') !!}
    {!! Form::select('address_id', \App\Models\Address::pluck('lat','id'), null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', \App\Models\User::pluck('name','id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
</div>
