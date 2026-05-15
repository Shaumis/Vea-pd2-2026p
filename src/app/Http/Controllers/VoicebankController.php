<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voicebank_Name;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VoicebankController extends Controller
{
    public function list(): View
    {
        $items = Voicebank_Name::orderBy('id', 'asc')->get();

        return view(
            'Voicebank_Name.list',
            [
                'title' => 'Voicebanks',
                'items' => $items,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'Voicebank_Name.form',
            [
                'title' => 'Pievienot VoiceBank',
                'voicebank' => new Voicebank_Name()
            ]
        );
    }
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $voicebanks = new Voicebank_Name();
        $voicebanks->name = $validatedData['name'];
        $voicebanks->save();

        return redirect('/voicebanks');
    }

    public function update(Voicebank_Name $voicebank): View
    {
        return view(
            'Voicebank_Name.form',
            [
                'title' => 'Edit voicebank',
                'voicebank' => $voicebank
            ]
        );
    }

    public function patch(Voicebank_Name $voicebank, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $voicebank->name = $validatedData['name'];
        $voicebank->save();

        return redirect('/voicebanks');
    }
    public function delete(Voicebank_Name $voicebank): RedirectResponse
    {
        // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
        $voicebank->delete();
        return redirect('/voicebanks');
    }

}
