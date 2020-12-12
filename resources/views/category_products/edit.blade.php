@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Category Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($categoryProduct, ['route' => ['categoryProducts.update', $categoryProduct->id], 'method' => 'patch']) !!}

                        @include('category_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection