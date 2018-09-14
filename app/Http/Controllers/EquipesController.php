<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipe;
use DB;


class EquipesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$teams = DB::table('equipes')->paginate(8);
        $teams = DB::table('equipes')
            ->orderBy('type', 'ASC')
            ->orderBy('rang', 'ASC')
            ->paginate(4);

        // Création d'une nouvelle ressource cURL
        $ch = curl_init();
         
        // Configuration de l'URL et d'autres options
        curl_setopt($ch, CURLOPT_URL, "https://worldcup.sfg.io/teams/group_results");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
         
        // Récupération de l'URL et affichage sur le naviguateur
        $response = curl_exec($ch);
        $response_a = json_decode($response, true);

        $groupes = [];
        $i = 0;
        foreach ($response_a as $groupes_a){
            $groupe_a = $groupes_a['ordered_teams'];
            $groupes[$i]['lettre'] = $groupes_a['letter'];
            $equipes = [];
            $j = 0;
            foreach ($groupe_a as $equipe_a){
                $equipes[$j]['pays'] = $equipe_a['country'];
                $equipes[$j]['points'] = $equipe_a['points']; 
                $equipes[$j]['wins'] = $equipe_a['wins'];
                $equipes[$j]['draws'] = $equipe_a['draws'];
                $equipes[$j]['losses'] = $equipe_a['losses'];
                $equipes[$j]['games_played'] = $equipe_a['games_played'];
                $equipes[$j]['goals_for'] = $equipe_a['goals_for'];
                $equipes[$j]['goals_against'] = $equipe_a['goals_against'];
                $equipes[$j]['goal_differential'] = $equipe_a['goal_differential'];
                                               
                $j++;
            }
            $groupes[$i]['equipes'] = $equipes;

            $i++;
        }

        // Fermeture de la session cURL
        curl_close($ch);  


        return view('equipes/equipes')->with('teams', $teams)->with('groupes', $groupes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $team = DB::table('equipes')->find($id);
        if ($team == NULL) {
            return view('errors/404');
        }
        else {
            $players = Equipe::find($id)->joueurs;
            $data = [
            'players'  => $players,
            'team'   => $team
            ];
            return view('equipes/equipe')->with('data',$data);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
