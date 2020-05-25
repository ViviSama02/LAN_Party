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
        $this->middleware('auth')->only(['register', 'unregister']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lans = Lan::all();
        return view('lans/index', compact('lans'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle LAN
     */
    public function create()
    {
<<<<<<< HEAD
        return view('lans/create');
=======
        return view('lans.create');
>>>>>>> 0b0265f96dbb8b2da7a234b95efb468ae0209acf
    }

    /**
     * Enregistre une nouvelle LAN de l'utilisateur après l'avoir créée via le formulaire
     */
<<<<<<< HEAD
    public function store(Request $request)
    {   if(Auth::check()){
          $this->validate($request,[
            'nom'=>'required',
            'max'=>'required',
            'date'=>'required',
            'info'=>'required']);
        }
=======
    public function store(StoreLan $request)
    {
        $validated = $request->validated();
        $lan = Auth::user()->lans()->create($validated);

        if($request->hasFile('image')) {
            $lan->saveThumbnail($request->file('image'));
        }

        return redirect()->route('lan.show', $lan)->with('alert', 'LAN créée avec succès');
>>>>>>> 0b0265f96dbb8b2da7a234b95efb468ae0209acf
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lan  $lAN
     * @return \Illuminate\Http\Response
     */
    public function show(Lan $lan)
    {
        return view('lans/show', compact('lan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lan  $lAN
     * @return \Illuminate\Http\Response
     */
    public function edit(Lan $lan)
    {
        return view('lans/edit', compact('lan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lan  $lAN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lan $lan)
    {
        $this->validate($request, [
            'nom' => ['required', Rule::unique('lans')->ignore($lan), 'max:255'],
            'info' => 'required|max:5000',
            'max' => 'required|integer|min:0|max:10000',
            'date' => ['required', 'date_format:"Y-m-d\TH:i"']
        ]);

        $lan->update($request->all());
        return redirect()->route('lan.show', $lan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lan  $lAN
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lan $lan)
    {
        //
    }

    /**
     * Appelé quand un utilisateur appuie sur le bouton "s'insrire" d'une LAN
     */
    public function register(Lan $lan)
    {
        if($lan->users->contains(Auth::user())) {
            return redirect()->back()
                ->with('status', 'Vous ne pouvez pas vous inscrire à une LAN où vous êtes déjà inscrit!')
                ->with('status-type', 'danger');
        }

        if($lan->noMorePlaces()) {
            return redirect()->back()
                ->with('status', "Il n'y a plus de places à cette LAN.")
                ->with('status-type', 'danger');
        }

        $lan->users()->save(Auth::user());


        return redirect()->back()
            ->with('status', 'Inscrit avec succès à la LAN')
            ->with('status-type', 'success');
    }

    /**
     * Appelé quand un utilisateur appuie sur le bouton "se désinscrire" d'une LAN
     */
    public function unregister(Lan $lan)
    {
        if(!$lan->users->contains(Auth::user())) {
            return redirect()->back()
                ->with('status', "Vous ne pouvez pas vous désinscrire d'une LAN où vous n'êtes pas inscrit!")
                ->with('status-type', 'danger');
        }

        $lan->users()->detach(Auth::user());

        return redirect()->back()
            ->with('status', 'Désinscrit avec succès à la LAN')
            ->with('status-type', 'warning');
    }
}
