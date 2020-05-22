<?php

namespace App;

use App\Exceptions\ChallongeException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

/**
 * Classe utilitaire pour gérer l'API de challonge
 */

class Challonge
{
    /**
     * Constante attendue par l'API de challonge pour le paramètre 'tournament_type'
     */
    const SINGLE_ELIM = 'single elimination';
    const DOUBLE_ELIM = 'double elimination';
    const ROUND_ROBIN = 'round robin';

    const TYPES = [
        [
            'value' => self::ROUND_ROBIN,
            'name' => 'Round Robin'
        ],
        [
            'value' => self::SINGLE_ELIM,
            'name' => 'Simple élimination'
        ],
        [
            'value' => self::DOUBLE_ELIM,
            'name' => 'Double élimination'
        ]
    ];

    /**
     * Clé API challonge
     */
    protected $api;

    public function __construct(string $api)
    {
        $this->api = $api;
    }

    protected function tournamentAction(int $id)
    {
        return "tournaments/$id";
    }

    /**
     * Envoie une requête à l'API challonge
     * @throws ChallongeException si une erreur survient
     */
    protected function api(string $method, string $action, array $postData = [], array $getData = [])
    {
        $getData += ['api_key' => $this->api];
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.challonge.com/v1/', 'verify' => false]);

        try {
            $response = $client->request($method, "$action.json", [
            'query' => $getData,
            'form_params' => $postData
            ]);

            $body = $response->getBody();
            $json = json_decode($body);
            return $json;

        } catch(ClientException  $exception) {
            $body = $exception->getResponse()->getBody();
            $json = json_decode($body);

            if(isset($json->errors)) {
                throw new ChallongeException($json->errors);
            }
            else {

                if(config('app.debug')) {
                    throw new ChallongeException(['Erreur ' . $exception->getMessage()]);
                }
                else {
                    throw new ChallongeException(['Erreur ' . $exception->getCode()]);
                }
            }

        } catch(ServerException $exception) {
            throw new ChallongeException(['Erreur interne au serveur challonge: ' . $exception->getMessage()]);
        }
    }

    protected function get(string $action, array $getData = [])
    {
        return $this->api('GET', $action, [], $getData);
    }

    protected function post(string $action, array $postData = [])
    {
        return $this->api('POST', $action, $postData, []);
    }

    protected function delete(string $action)
    {
        return $this->api('DELETE', $action);
    }

    /**
     * Créé un nouveau tournoi.
     * @param string $nomTournoi Le nom du tournoi
     * @param string $typeTournoi Le type du tournoi (utiliser une des constantes single elim/double elim/round robin)
     * @return La réponse du serveur
     * @throws ChallongeException si une erreur survient
     */
    public function createTournament(Tournament $tournament)
    {
        $postData = [
            'tournament' => [
                'name' => $tournament->nom,
                'tournament_type' => $tournament->type,
                'url' => uniqid()
            ]
        ];

        $json = $this->post( 'tournaments', $postData);
        if(!isset($json->tournament)) {
            throw new ChallongeException("Erreur interne: champ manquant dans la réponse de l'API");
        }
        else {
            $tournament = $json->tournament;
            return $tournament;
        }
    }

    public function createParticipant(Team $team)
    {
        $postData = [
            'participant' => [
                'name' => $team->nom
            ]
        ];

        $idTournoi = $team->tournament->challonge_id;
        $json = $this->post("tournaments/$idTournoi/participants", $postData);
        if(!isset($json->participant)) {
            throw new ChallongeException("Erreur interne: champ manquant dans la réponse de l'API");
        }
        else {
            $participant = $json->participant;
            return $participant;
        }
    }

    public function createMassParticipants(Tournament $tournament, $teams)
    {
        $participants = [];
        foreach($teams as $team) {
            $participants[] = [
                'name' => $team->name
            ];
        }
        $postData = [
            'participants' => $participants
        ];

        $idTournoi = $tournament->tournament;
        $json = $this->post("tournaments/$idTournoi/participants/bulk_add", $postData);
        return $json;
    }

    public function startTournament(Tournament $tournament)
    {
        $idTournament = $tournament->tournament;
        $json = $this->post( "tournaments/$idTournament/start");
        return $json;
    }

    public function deleteParticipant(Team $team)
    {
        $postData = [
            'participant' => [
                'name' => $team->nom
            ]
        ];

        $idTournoi = $team->tournament->challonge_id;
        $idParticipant = $team->challonge_id;
        $json = $this->delete("tournaments/$idTournoi/participants/$idParticipant");
        if(!isset($json->participant)) {
            throw new ChallongeException("Erreur interne: champ manquant dans la réponse de l'API");
        }
        else {
            $participant = $json->participant;
            return $participant;
        }
    }

    /**
     * Récupère les informations d'un tournoi
     */
    public function getTournament(int $idTournoi)
    {
        $args = ['tournament' => $idTournoi];
        $json = $this->get($this->tournamentAction($idTournoi), $args);

        if(isset($json->tournament)) {
            $tournament = $json->tournament;
        }
        else {
            $tournament = false;
        }

        return $tournament;
    }
}