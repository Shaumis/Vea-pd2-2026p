@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif

    <form method="post" action="{{ $voicebank->exists ? '/voicebanks/patch/' . $voicebank->id : '/voicebanks/put' }}">
        @csrf

        <div class="mb-3">
            <label for="voicebank-name" class="form-label">VoiceBank Name</label>

            <input type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="voicebank-name"
            name="name" value="{{ old('name', $voicebank->name) }}"

>
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">{{ $voicebank->exists ? '/voicebanks/patch/' . $voicebank->id : '/voicebanks/put' }}</button>

    </form>

@endsection