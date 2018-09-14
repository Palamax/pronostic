@extends('layouts.app')

@section('content')
        <div class = "row" style = "margin-top:50px;">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card ">
                    <div class="card-header text-white mb-3 colorBlue"  >Equipes <span class = "float-right"><strong>Groupe {{$teams[0]->type}} </strong></span></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tableProno" class="table table-condensed">
                                    <thead class="thead-dark">
                                    <th style="width:5%;"></th>
                                    <th class= "text-center" > Pays </th>
                                    <th class= "text-center d-none d-sm-block " >Nom </th>
                                    <th class= "text-center" > Classement FIFA  </th>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($teams as $team)

                                        @if(isset($_GET['page']))
                                            @php( $j = $i + 8 * ($_GET['page'] - 1))
                                        @else
                                            @php( $j = $i )
                                        @endif
                                        @php($pays = str_replace("_", " ", $team->pays))
                                        <tr class='clickable-row' data-href="{{url('equipes',['id'=>$team->id])}}">

                                            <td class = "text-center"><img  src = "./img/country/{{$team->pays}}.png">                     </td>
                                            <td class = "text-center"> {{$pays}}                           </td>
                                            <td class = "text-center d-none d-sm-block"> {{$team->nom}}                             </td>
                                            <td class = "text-center"> {{$team->rang}}                             </td>

                                        </tr>
                                        @php ($i++)
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-8 offset-md-2">
            {{ $teams->links() }}
        </div>
        </div>


        <div class = "row" style = "margin-top:50px;">
            <div class="col-12 d-block mx-auto">
                <div class="card ">
                    <div class="card-header text-center alert-info"><h3>Groupes</h3>
                        <i class="text-center" style = "font-size:12px">Classement des équipes par groupe</i>
                    </div>

                    <div class="card-body ">
                        @php ($i = 1)
                        @if (count($groupes) == 0)
                                <div class="alert alert-warning" >Pas de groupes</div>
                        @endif
                        @foreach ($groupes as $key => $value)
                            <p  class = "row">
                                <div class="card">
                                    <div class="card-header text-center alert alert-success" >
                                        <span class = "float-leftnowrap">
                                               <span class = "text-success"><strong>Groupe {{$value["lettre"]}}</strong> </span>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        @php ($j = 1)
                                        @if (count($value["equipes"]) == 0)
                                                <div class="alert alert-warning" >Aucune équipe dans ce groupe</div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <thead class="thead-dark">
                                                <th class= "text-center">Equipes</th>
                                                <th class= "text-center" >MJ</th>
                                                <th class= "text-center">V</th>
                                                <th class= "text-center">N</th>
                                                <th class= "text-center">D</th>
                                                <th class= "text-center">BP</th>
                                                <th class= "text-center">BC</th>
                                                <th class= "text-center">DB</th>
                                                <th class= "text-center">Points</th>
                                                </thead>
                                                <tbody>
                                                @foreach ($value["equipes"] as $key2 => $equipe)
                                                    <tr>
                                                        <td class = "text-left"><strong>{{$equipe["pays"]}}</strong></td>
                                                        <td class = "text-center">{{$equipe["games_played"]}}</td>
                                                        <td class = "text-center">{{$equipe["wins"]}}</td>
                                                        <td class = "text-center">{{$equipe["draws"]}}</td>
                                                        <td class = "text-center">{{$equipe["losses"]}}</td>
                                                        <td class = "text-center">{{$equipe["goals_for"]}}</td>
                                                        <td class = "text-center">{{$equipe["goals_against"]}}</td>
                                                        <td class = "text-center">{{$equipe["goal_differential"]}}</td>
                                                        <td class = "text-center"><strong>{{$equipe["points"]}}</strong></td>
                                                    </tr>
                                                    @php ($j++)
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </p>
                            @php ($i++)
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script> jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
                $(".clickable-row").hover(function() {
                    $(this).css( 'cursor', 'pointer')
                        .toggleClass("colorBlue")
                        .siblings(".selected")
                        .removeClass("selected");
                });
            });
        </script>
@endsection
