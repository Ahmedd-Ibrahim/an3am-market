@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productUser, ['route' => ['productUsers.update', $productUser->id], 'method' => 'patch']) !!}

                        @include('product_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection