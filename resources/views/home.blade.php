
@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
         {{ session('status') }}
    </div>
@endif



<!-- PROCHAINS MATCHS -->
<div class="row">
    <div class="col-12  col-md-5   mt-5" >
        <div class="card ">
            <div class="card-header text-center text-white colorBlue" >Prochains matchs<br>
            </div>
            <div class="card-body"  style="height:250px;">
                <div class="row">
                    <div class=" col-12 "></div>

                    <table class="table  table-sm">
                        <tbody>

                        {{Jenssegers\Date\Date::setLocale('fr')}}

                        @if (count($matchs_prono) === 0)
                            <tr><td colspan="3" class = "text-center">Aucun match à pronostiquer.</td></tr>
                        @else
                        @foreach ($matchs_prono as $match_prono)
                        <tr>
                            <td>Le {{ Jenssegers\Date\Date::parse($match_prono->date_match)->format('d/m à H:i')}} </td>

                        @php($equipe_prono1 = str_replace("_", " ", $match_prono->equipe1))
                        @php($equipe_prono2 = str_replace("_", " ", $match_prono->equipe2))

                        <td class = "text-center">
                            <!--<img  class = "d-none d-sm-block" src = "/img/country/{{$match_prono->equipe1}}.png" style="vertical-align : -3px;">-->
                            <span class = "text-center">{{$equipe_prono1 }}-{{$equipe_prono2 }}</span>
                            <!--<img  class = "d-none d-sm-block" src = "img/country/{{$match_prono->equipe2 }}.png" style="vertical-align : -3px;" >-->
                        </td>
                        <td class="text-center" style= "vertical-align:middle;" ><img  src = "img/chaine/{{$match_prono->chaine_TV}}.png" ></td>
                         </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12  col-md-5 offset-md-2 mt-5" >
        <div class="card">
            <div class="card-header text-center text-white colorBlue" >Derniers résultats</div>
            <div class="card-body"  style="height:250px;">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 "></div>

                    <table class="table table-sm">
                        <tbody>

                        {{Jenssegers\Date\Date::setLocale('fr')}}
                        @if (count($matchs_end) === 0)
                            <tr><td colspan="3" class = "text-center">Aucun match commencé</td></tr>
                        @else
                        @foreach ($matchs_end as $match_end)
                            <tr>
                                <td>Le {{ Jenssegers\Date\Date::parse($match_end->date_match)->format('d/m')}} </td>
                                <!-- <td style= "vertical-align:middle;"> Le '.date_format($date,'d/m').' à '.$heure.'</td>-->

                                @php($equipe_end1 = str_replace("_", " ", $match_end->equipe1))
                                @php($equipe_end2 = str_replace("_", " ", $match_end->equipe2))

                                <td class ="text-center" style= "vertical-align:middle;">
                                    <!--<img class = "d-none d-sm-block img-fluid mr-3" src = "/img/country/{{$match_end->equipe1}}.png" style="float:left">-->
                                    <span >{{$equipe_end1 }}-{{$equipe_end2 }}</span>
                                   <!-- <img class = "d-none d-sm-block img-fluid pr-5"  src = "img/country/{{$match_end->equipe2 }}.png" style="float:right" >-->
                                </td>
                                <td>
                                    <span class = "text-center">{{$match_end->resultat1 }}-{{$match_end->resultat2 }}</span>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-left: auto;margin-right: auto;margin-top:20px"><img  src = "./img/podium.png"></div>
</div>
<!-- PROCHAINS MATCHS -->
<div class="row"><br>
    <div class="col-12  col-md-5   mt-5" >
        <div class="card ">
            <div class="card-header text-center text-white colorRed" >Retardataires<br>
            </div>
            <div class="card-body"  style="height:250px;overflow:scroll;height:250px;">
                <div class="row">
                    <div class=" col-12 "></div>

                    <table class="table  table-sm">
                        <tbody>
                        {{Jenssegers\Date\Date::setLocale('fr')}}
                        @if (count($retardataires) === 0)
                            <tr><td class = "text-center">Aucun retardataire</td></tr>
                        @else
                        @foreach ($retardataires as $retardataire)
                            <tr>
                                <td class ="text-center" style= "vertical-align:middle;">
                                    <span >{{$retardataire->prenom }} {{$retardataire->nom }} </span>
                                    @if ($retardataire->TYPE === '0')
                                    <span >   (J)</span>
                                    @endif
                                    @if ($retardataire->TYPE === '1')
                                    <span >   (J+1)</span>
                                    @endif                                    
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12  col-md-5 offset-md-2 mt-5" >
        <div class="card">
            <div class="card-header text-center text-white colorGreen" >Tchat - Ouvert !! </div>
            <div class="card-body"  style="height:250px;overflow:scroll;height:250px;">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 "></div>

                    <table class="table table-sm">
                        <tbody>

                        {{Jenssegers\Date\Date::setLocale('fr')}}
                        @if (count($messages) === 0)
                            <tr><td colspan="3" class = "text-center">Aucun message</td></tr>
                        @else
                        @foreach ($messages as $mess)
                            <tr>
                                <td>
                                    <span class = "text-center">{{$mess->text}}</span>
                                </td>
                                <td>
                                    <span class = "text-center">{{$mess->user->pseudo}}</span>
                                </td>                                 
                                <td>
                                    <span class = "text-center">{{ Jenssegers\Date\Date::parse($mess->created_at)->format('d/m H:i')}}</span>
                                </td>                                
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>               
            </div>           
        </div>
    {!! Form::open(['action' => ['HomeController@tchat'], 'method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
            <div class="form-group">    
                {{form::text('message', $message->text, ['class' => 'form-control', 'placeholder' => 'Message'])}}
            </div>
            {{Form::hidden('_method','PUT')}}   

    {!! Form::close() !!}           
    </div>
</div>
<!--
<br>
<div class="row">
<iframe src="https://www.francefootball.fr/coupe-du-monde/resultats/2018/calendrier" width="100%" height="800"></iframe>
</div>-->

<div style = "margin-bottom:100px"> </div>

@endsection