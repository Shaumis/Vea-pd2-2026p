@extends('layout') @section('content') <h1>{{ $title }}</h1> @if (count($items) > 0)
        <table class="table table-sm table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nosaukums</th>
                    <th>VoiceBank</th>
                    <th>Attēls</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody> @foreach($items as $song) <tr>
                <td>{{ $song->id }}</td>
                <td>{{ $song->name }}</td>
                <td>{{ $song->voicebank?->name ?? 'N/A' }}</td>
                <td>
                    @if ($song->image)
                        <img src="{{ asset('images/' . $song->image) }}" alt="{{ $song->name }}" class="img-fluid img-thumbnail" style="max-width:64px; height:auto;" />
                    @else
                        <span class="text-muted">&#x274C;</span>
                    @endif
                </td>
                <td> <a href="/songs/update/{{ $song->id }}" class="btn btn-outline-primary btn-sm">Labot</a> / <form
                        action="/songs/delete/{{ $song->id }}" method="post" class="deletion-form d-inline"> @csrf <button
                            type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button> </form>
                </td>
            </tr> @endforeach </tbody>
    </table> @else <p>Nav atrasts neviens ieraksts</p> @endif <a href="/songs/create" class="btn btn-primary">Izveidot
jaunu</a> @endsection