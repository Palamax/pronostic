<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pronostic;
use App\Match;


class DirectController extends Controller
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

    public function afficherDirect()    
    {
        return $this->afficher("http://worldcup.sfg.io/matches/today")->with('choix', 'direct');
    }

    public function afficherHistorique()    
    {
        return $this->afficher("http://worldcup.sfg.io/matches")->with('choix', 'historique');
    }    

    private function afficher($url)    
    {
        // Création d'une nouvelle ressource cURL
        $ch = curl_init();

         // Configuration de l'URL et d'autres options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
         
        // Récupération de l'URL et affichage sur le naviguateur
        $response = curl_exec($ch);
        $response_a = json_decode($response, true);


        $matchs = [];
        $i = 0;
        foreach ($response_a as $match){
            $matchs[$i]['ville'] = $match['venue'];
            $matchs[$i]['stade'] = $match['location'];
            $matchs[$i]['time'] = $match['time'];

            $matchs[$i]['status'] = $match['status'];
            $matchs[$i]['equipe1'] = $match['home_team']['country'];
            $matchs[$i]['equipe2'] = $match['away_team']['country'];
            $matchs[$i]['score1'] = 0;
            $matchs[$i]['score2'] = 0;
            if ($match['status'] != 'future'){
                $matchs[$i]['score1'] = $match['home_team']['goals'];
                $matchs[$i]['score2'] = $match['away_team']['goals'];
                $events = $match['home_team_events'];
                $buteur1=' ';
                $buteur2=' ';
                $cjaune1=' ';
                $cjaune2=' ';    
                $crouge1=' ';
                $crouge2=' ';    
                foreach ($events as $event){
                    $pos = strpos($event['type_of_event'], 'goal');
                    if ($pos !== false) {
                        $buteur1=$buteur1.' '.$event['player'].' ('.$event['time'].')    ';
                    }
                    if ($event['type_of_event'] == 'yellow-card'){
                        $cjaune1=$cjaune1.' '.$event['player'].' ('.$event['time'].')    ';
                    }
                    if ($event['type_of_event'] == 'red-card'){
                        $crouge1=$crouge1.' '.$event['player'].' ('.$event['time'].')   ';
                    }       
                }
                $matchs[$i]['buteur1'] = $buteur1;
                $matchs[$i]['cjaune1'] = $cjaune1;
                $matchs[$i]['crouge1'] = $crouge1;
                
                $events = $match['away_team_events'];
                foreach ($events as $event){
                    $pos = strpos($event['type_of_event'], 'goal');
                    if ($pos !== false) {
                        $buteur2=$buteur2.' '.$event['player'].' ('.$event['time'].')   ';
                    }
                    if ($event['type_of_event'] == 'yellow-card'){
                        $cjaune2=$cjaune2.' '.$event['player'].' ('.$event['time'].')   ';
                    }
                    if ($event['type_of_event'] == 'red-card' || $event['type_of_event'] == 'yellow-card-second'){
                        $crouge2=$crouge2.' '.$event['player'].' ('.$event['time'].')   ';
                    }       
                }
                $matchs[$i]['buteur2'] = $buteur2;
                $matchs[$i]['cjaune2'] = $cjaune2;
                $matchs[$i]['crouge2'] = $crouge2;
                
                $matchs[$i]['possession1'] = $match['home_team_statistics']['ball_possession'];
                $matchs[$i]['possession2'] = $match['away_team_statistics']['ball_possession'];
                $matchs[$i]['tir1'] = $match['home_team_statistics']['attempts_on_goal'];
                $matchs[$i]['tir2'] = $match['away_team_statistics']['attempts_on_goal'];
                $matchs[$i]['tircadre1'] = $match['home_team_statistics']['on_target'];
                $matchs[$i]['tircadre2'] = $match['away_team_statistics']['on_target'];

                $matchs[$i]['distance1'] = $match['home_team_statistics']['distance_covered'];
                $matchs[$i]['distance2'] = $match['away_team_statistics']['distance_covered'];
                $matchs[$i]['passereussi1'] = $match['home_team_statistics']['pass_accuracy'];
                $matchs[$i]['passereussi2'] = $match['away_team_statistics']['pass_accuracy'];
                $matchs[$i]['passe1'] = $match['home_team_statistics']['num_passes'];
                $matchs[$i]['passe2'] = $match['away_team_statistics']['num_passes'];
                $matchs[$i]['faute1'] = $match['home_team_statistics']['fouls_committed'];
                $matchs[$i]['faute2'] = $match['away_team_statistics']['fouls_committed'];

            }
            $i++;
        }
            


        // Fermeture de la session cURL
        curl_close($ch);  
        return view('pronostics/direct_table')->with('matchs', $matchs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pronostics/direct')->with('choix', 'direct');
       
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
 
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
