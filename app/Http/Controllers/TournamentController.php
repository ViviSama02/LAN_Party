<?php

namespace App\Http\Controllers;

use App\Exceptions\ChallongeException;
use App\Lan;
use App\Team;
use App\Tournament;
use App\Challonge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TournamentController extends Controller
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
    public function index(Lan $lan)
    {
        $tournaments = $lan->tournaments;
        return view('tournament.index', compact('lan', 'tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lan $lan)
    {
        return view('tournament.create', compact('lan') + ['types' => Challonge::TYPES]);
    }

    /**
     * Lancer le début d'un tournoi
     */
    public function start(Tournament $tournament)
    {
        $lan = $tournament->lan;

        $json = $tournament->challonge()->startTournament($tournament);

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Tournoi commencé avec succès.')
            ->with('status-type', 'info');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lan $lan)
    {
        $request->validate([
            'nom' =>  'required|string',
            'api' => 'required',
            'type' => Rule::in(array_column(Challonge::TYPES, 'value'))
        ]);

        try {
            $tournament = $lan->tournaments()->create($request->all());
        } catch(ChallongeException $exception) {
            throw ValidationException::withMessages(['api' => $exception->getErrors()]);
        }

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lan $lan, Tournament $tournament)
    {
        $user = Auth::user();
        $teams = $tournament->teams()->get();
        $userTeam = null;

        $userTeams = $user ?$user->teams()->withPivot('accepte')->where('teams.tournament_id', $tournament->id)->get() : [];
        $userTeamsStatus = [];

        foreach($userTeams as $team)
        {
            $userTeamsStatus[$team->id] = $team->pivot->accepte;
            if($team->pivot->accepte) {
                $userTeam = $team;
            }
        }


        return view('tournament.show', compact('lan', 'tournament', 'teams', 'userTeam', 'userTeamsStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lan $lan, Tournament $tournament)
    {
        $types = Challonge::TYPES;
        return view('tournament.edit', compact('lan', 'tournament', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lan $lan, Tournament $tournament)
    {
        $request->validate([
            'nom' => 'required|string'
        ]);

        $tournament->update($request->all());
        return redirect()->route("lan.tournament.show", compact('lan', 'tournament'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('tournament.index');
    }

    public function register(Lan $lan, Tournament $tournament)
    {
        $user = Auth::user();

        if($tournament->isRegistered(Auth::user())) {
            return redirect()->back()
                ->with('status', 'Vous ne pouvez pas vous inscrire à un tournoi où vous êtes déjà inscrit!')
                ->with('status-type', 'danger');
        }

        try {
            $tournament->register($user);
        } catch(ChallongeException $exception) {
            return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
                ->with('status', join('; ', $exception->getErrors()))
                ->with('status-type', 'danger');
        }

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Inscrit avec succès au Tournoi')
            ->with('status-type', 'success');
    }

    public function unregister(Lan $lan, Tournament $tournament)
    {
        $user = Auth::user();
        $team = $user->team($tournament);

        if($team == null) {
            return redirect()->back()
                ->with('status', "Vous ne pouvez pas vous désinscrire d'un Tournoi où vous n'êtes pas inscrit!")
                ->with('status-type', 'danger');
        }

        try {
            $tournament->unregister($user);
        } catch(ChallongeException $exception) {
            return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
                ->with('status', join('; ', $exception->getErrors()))
                ->with('status-type', 'danger');
        }

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Désinscrit avec succès au Tournoi')
            ->with('status-type', 'info');
    }
}
