<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $settings->id }}</p>
</div>

<!-- Intro Ar Photo Field -->
{!! Form::label('intro_ar_photo', 'Intro Arabic Photo:') !!}
<div class="form-group">

    <img src="{{asset('images/'.$settings->intro_ar_photo)}}" alt="">
</div>

<!-- Intro En Photo Field -->
{!! Form::label('intro_en_photo', 'Intro English Photo:') !!}
<div class="form-group">
    <img src="{{asset('images/'.$settings->intro_en_photo)}}" alt="">
</div>

<!-- Intro Ar Title Field -->
<div class="form-group">
    {!! Form::label('intro_ar_title', 'Intro Arabic Title:') !!}
    <p>{{ $settings->intro_ar_title }}</p>
</div>

<!-- Intro En Title Field -->
<div class="form-group">
    {!! Form::label('intro_en_title', 'Intro English Title:') !!}
    <p>{{ $settings->intro_en_title }}</p>
</div>

<!-- Intro Ar Desc Field -->
<div class="form-group">
    {!! Form::label('intro_ar_desc', 'Intro Arabic Desc:') !!}
    <p>{{ $settings->intro_ar_desc }}</p>
</div>

<!-- Intro En Desc Field -->
<div class="form-group">
    {!! Form::label('intro_en_desc', 'Intro English Desc:') !!}
    <p>{{ $settings->intro_en_desc }}</p>
</div>

<!-- About Ar Field -->
<div class="form-group">
    {!! Form::label('about_ar', 'About Arabic:') !!}
    <p>{{ $settings->about_ar }}</p>
</div>

<!-- About En Field -->
<div class="form-group">
    {!! Form::label('about_en', 'About English:') !!}
    <p>{{ $settings->about_en }}</p>
</div>

<!-- Condation Ar Field -->
<div class="form-group">
    {!! Form::label('condation_ar', 'Condation Ararabic:') !!}
    <p>{{ $settings->condation_ar }}</p>
</div>

<!-- Condation En Field -->
<div class="form-group">
    {!! Form::label('condation_en', 'Condation English:') !!}
    <p>{{ $settings->condation_en }}</p>
</div>

<!-- Privcy Ar Field -->
<div class="form-group">
    {!! Form::label('privcy_ar', 'Privcy Arabic:') !!}
    <p>{{ $settings->privcy_ar }}</p>
</div>

<!-- Privcy En Field -->
<div class="form-group">
    {!! Form::label('privcy_en', 'Privcy English:') !!}
    <p>{{ $settings->privcy_en }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $settings->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $settings->updated_at }}</p>
</div>

