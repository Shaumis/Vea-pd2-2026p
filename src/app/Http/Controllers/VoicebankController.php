<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voicebank;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VoicebankController extends Controller
{
    public function list(): View
    {
        $items = Voicebank::orderBy('id', 'asc')->get(); // Updated here

        return view('voicebank.list', [
            'title' => 'Voicebanks',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('voicebank.form', [
            'title' => 'Pievienot VoiceBank',
            'voicebank' => new Voicebank() // Updated here
        ]);
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $voicebanks = new Voicebank(); // Updated here
        $voicebanks->name = $validatedData['name'];
        $voicebanks->save();

        return redirect('/voicebanks');
    }

    // Update type-hints for Route Model Binding:
    public function update(Voicebank $voicebank): View
    {
        return view('voicebank.form', [
            'title' => 'Edit voicebank',
            'voicebank' => $voicebank
        ]);
    }

    public function patch(Voicebank $voicebank, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $voicebank->name = $validatedData['name'];
        $voicebank->save();

        return redirect('/voicebanks');
    }

    public function delete(Voicebank $voicebank): RedirectResponse
    {
        $voicebank->delete();
        return redirect('/voicebanks');
    }
}