@extends('organiser.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formonderdelen dashboard</div>

                <div class="card-body">
                    @foreach($formulieronderdelen as $onderdeel)
                        <br>
                        <div class="row">
                            <div class="col-6">
                                {{ ucfirst($onderdeel->onderdeel) }}
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('organiser.formulieronderdeel', ['formulieronderdeel' => $onderdeel->id]) }}">Klik hier voor info</a>
                                <a class="btn btn-secondary" href="{{ route('organiser.formulieronderdeel.download', ['formulieronderdeel' => $onderdeel->id]) }}">Klik hier voor download</a>
                            </div>
                        </div>
{{--                        <hr style="margin-bottom: 0; margin-top: 0;">--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
