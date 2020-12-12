@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Slider
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'sliders.store', 'files' => true]) !!}

                        @include('sliders.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
