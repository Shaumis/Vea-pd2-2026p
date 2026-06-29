@extends('layout') @section('content') <h1>{{ $title }}</h1> @if ($errors->any())
    <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div> @endif <form method="post"
        action="{{ $song->exists ? '/songs/patch/' . $song->id : '/songs/put' }}" enctype="multipart/form-data"> @csrf <div class="mb-3"> <label
                for="song-name" class="form-label">Nosaukums</label> <input type="text" id="song-name" name="name"
                value="{{ old('name', $song->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name') <p class="invalid-feedback">{{ $errors->first('name') }}</p> @enderror </div>
        <div class="mb-3"> <label for="song-voicebank" class="form-label">VoiceBank</label> <select id="song-voicebank"
                name="voicebank_id" class="form-select @error('voicebank_id') is-invalid @enderror">
                <option value="">Norādiet VoiceBank!</option> @foreach($voicebanks as $voicebank) <option
                value="{{ $voicebank->id }}" {{ old('voicebank_id', $song->voicebank_id) == $voicebank->id ? 'selected' : '' }}>{{ $voicebank->name }}</option> @endforeach
            </select> @error('voicebank_id') <p class="invalid-feedback">{{ $errors->first('voicebank_id') }}</p> @enderror
        </div> <button type="submit" class="btn btn-primary">{{ $song->exists ? 'Labot' : 'Izveidot' }}</button>
        
        <div class="mb-3"> <label for="song-image" class="form-label">Attēls</label> @if ($song->image) <img
            src="{{ asset('images/' . $song->image) }}" class="img-fluid img-thumbnail d-block mb-2"
        alt="{{ $song->name }}"> @endif <input type="file" accept="image/png, image/jpeg, image/webp"
                id="song-image" name="image" class="form-control @error('image') is-invalid @enderror"> @error('image') <p
                class="invalid-feedback">{{ $errors->first('image') }}</p> @enderror </div>
</form> @endsection