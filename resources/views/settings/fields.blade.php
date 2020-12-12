<!-- Intro Ar Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_ar_photo', 'Intro Ar Photo:') !!}
    {!! Form::file('intro_ar_photo') !!}
</div>
<div class="clearfix"></div>

<!-- Intro En Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_en_photo', 'Intro En Photo:') !!}
    {!! Form::file('intro_en_photo') !!}
</div>
<div class="clearfix"></div>

<!-- Intro Ar Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_ar_title', 'Intro Ar Title:') !!}
    {!! Form::text('intro_ar_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Intro En Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_en_title', 'Intro En Title:') !!}
    {!! Form::text('intro_en_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Intro Ar Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_ar_desc', 'Intro Ar Desc:') !!}
    {!! Form::text('intro_ar_desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Intro En Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro_en_desc', 'Intro En Desc:') !!}
    {!! Form::text('intro_en_desc', null, ['class' => 'form-control']) !!}
</div>

<!-- About Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('about_ar', 'About Ar:') !!}
    {!! Form::text('about_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- About En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('about_en', 'About En:') !!}
    {!! Form::text('about_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Condation Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condation_ar', 'Condation Ar:') !!}
    {!! Form::text('condation_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Condation En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condation_en', 'Condation En:') !!}
    {!! Form::text('condation_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Privcy Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('privcy_ar', 'Privcy Ar:') !!}
    {!! Form::text('privcy_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Privcy En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('privcy_en', 'Privcy En:') !!}
    {!! Form::text('privcy_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('settings.index') }}" class="btn btn-default">Cancel</a>
</div>
