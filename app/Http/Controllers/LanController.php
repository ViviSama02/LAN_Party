<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLan;
use App\Lan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LanController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Lan::class, 'lan');
    }

    /**
     * Affiche la liste de toutes les LANs
     */
    public function index()
    {
        $now = now();
        $lans = Lan::where('date', '>=', $now)->orderBy('date')->get();
        $lansFinies = Lan::where('date', '<', $now)->orderBy('date', 'desc')->get();
        $lans = $lans->merge($lansFinies);
        return view('lans.index', compact('lans'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle LAN
     */
    public function create()
    {
        return view('lans.create');
    }

    /**
     * Enregistre une nouvelle LAN de l'utilisateur après l'avoir créée via le formulaire
     */
    public function store(StoreLan $request)
    {
        $validated = $request->validated();
        $lan = Auth::user()->lans()->create($validated);

        if($request->hasFile('image')) {
            $lan->saveThumbnail($request->file('image'));
        }

        return redirect()->route('lan.show', $lan)->with('alert', 'LAN créée avec succès');
    }

    /**
     * Affiche les informations sur une LAN spécifique
     */
    public function show(Lan $lan)
    {
        return view('lans.show', compact('lan'));
    }

    /**
     * Edite une LAN déjà créée par le propriétaire de la LAN
     */
    public function edit(Lan $lan)
    {
        return view('lans.create', compact('lan'));
    }

    /**
     * Modifie les informations sur une LAN via le formulaire d'édition
     */
    public function update(StoreLan $request, Lan $lan)
    {
        $validated = $request->validated();
        $lan->update($validated);

        if($request->hasFile('image')) {
            $lan->saveThumbnail($request->file('image'));
        }

        return redirect()->route('lan.show', $lan)->with('alert', 'LAN modifiée avec succès');
    }

    /**
     * Supprime une LAN
     */
    public function destroy(Lan $lan)
    {
        $lan->delete();
        return redirect()->route('lan.index')->with('alert', 'LAN supprimée avec succès');
    }
}
