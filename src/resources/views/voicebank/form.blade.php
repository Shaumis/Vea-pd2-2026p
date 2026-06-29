@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    <form action="{{ $voicebank->id ? '/voicebanks/patch/' . $voicebank->id : '/voicebanks/put' }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Voicebank Nosaukums</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $voicebank->name) }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Saglabāt</button>
        <a href="/voicebanks" class="btn btn-secondary">Atcelt</a>
    </form>

@endsection