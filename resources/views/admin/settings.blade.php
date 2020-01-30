@extends('admin.layouts.app')
@section('content')

@forelse($settings as $setting)
    {!! Form::open(['url' => route('admin.settings.update', ['setting' => $setting->id]), 'method' => 'PUT']) !!}
    {!! Form::label($setting->id, ucfirst($setting->name)) !!}
    <div class="form-inline">
        @if($setting->type == 'date')
            {!! Form::date('value', $setting->value, [ 'class' => 'form-control mr-sm-2']) !!}
        
        @elseif($setting->type == 'text')
            {!! Form::text('value', $setting->value, [ 'class' => 'form-control mr-sm-2']) !!}
            
        @elseif($setting->type == 'boolean')
            {!! Form::select('value', ['0' => 'Nee', '1' => 'Ja'], $setting->value), null,  ['class' => 'custom-select mr-sm-2'] !!}
       
        @endif
        {!! Form::submit('Opslaan', ['class' => 'btn btn-primary mr-sm-2']) !!}
    </div>
    {!! Form::close() !!}
        
@empty
    <h2>Geen instellingen bekend</h2>
@endforelse

@endsection
