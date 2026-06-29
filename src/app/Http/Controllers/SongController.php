<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Song;
use App\Models\Voicebank;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\SongRequest;

class SongController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth',];
    }

    public function list(): View
    {
        $items = Song::orderBy('name', 'asc')->get();
        return view('song.list', ['title' => 'Dziesmas', 'items' => $items]);
    }

    public function create(): View
    {
        $voicebanks = Voicebank::orderBy('name', 'asc')->get();
        return view('song.form', ['title' => 'Pievienot dziesmu', 'song' => new Song(), 'voicebanks' => $voicebanks]);
    }

    private function saveSongData(Song $song, SongRequest $request): void
    {
        $validatedData = $request->validated();
        // Fill attributes except the uploaded file
        $song->fill($validatedData);

        // Handle uploaded image file (store in public/images and save filename)
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $filename = $name . '.' . $extension;
            // Ensure the images directory exists and move the uploaded file there
            $imagesPath = public_path('images');
            if (!file_exists($imagesPath)) {
                mkdir($imagesPath, 0755, true);
            }
            $uploadedFile->move($imagesPath, $filename);
            $song->image = $filename;
        }

        $song->save();
    }
    public function put(SongRequest $request): RedirectResponse
    {
        $song = new Song();
        $this->saveSongData($song, $request);
        return redirect('/songs');
    }
    public function patch(Song $song, SongRequest $request): RedirectResponse
    {
        $this->saveSongData($song, $request);
        return redirect('/songs/update/' . $song->id);
    }
    public function update(Song $song): View
    {
        $voicebanks = Voicebank::orderBy('name', 'asc')->get();
        return view('song.form', ['title' => 'Rediģēt dziesmu', 'song' => $song, 'voicebanks' => $voicebanks]);
    }
    public function delete(Song $song): RedirectResponse
    {
        if ($song->image) {
            unlink(getcwd() . '/images/' . $song->image);
        }
        $song->delete();
        return redirect('/songs');
    }

    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voicebank_id');
            $table->string('name', 256);
            $table->string('image', 256)->nullable();
            $table->timestamps();
        });
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'voicebank_id' => 'voicebank',
            'image' => 'attēls',
        ];
    }
}