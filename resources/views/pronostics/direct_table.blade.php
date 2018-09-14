<form class="form-horizontal" action="direct" method="post">

@php ($i = 1)
@if (count($matchs) == 0)
        <div class="alert alert-warning" >Aucun match aujourd'hui</div>
@endif
@foreach ($matchs as $key => $value)
    <p  class = "row">
        <div class="card">
             <div class="card-header text-center alert alert-success" >
                <span class = "float-left col-2 nowrap">
                       <span class = "text-success"><strong>{{$value["status"]}}</strong> <br> {{$value["time"]}}</span>
                </span>
                <span class="mt-2 pr-0  col-3 text-right" style ="font-size:1.5em;">
                    {{$value["equipe1"]}}
                </span>
                <span class = "col-2 text-center text-dark">
                        <strong style ="font-size:1.5em;">{{$value["score1"]}}  - {{$value["score2"]}} </strong>
                </span>
                <span class="mt-2 col-3 text-left pl-0" style ="font-size:1.5em;">
                    {{$value["equipe2"]}}
                </span>
                <span class = "float-right col-2 text-right text-success nowrap">{{$value["stade"]}} ({{$value["ville"]}})</span>                      
            </div>


            <div class="card-body">

                @if ($value["status"] != 'future')
                    <table style="width:100%;">
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["buteur1"]}}</td>
                        <td class="text-center" style="width:20%;"><strong>Buteurs</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["buteur2"]}}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);"> 
                        <td class="text-center" style="width:40%;">{{$value["tir1"]}} dont {{$value["tircadre1"]}} cadré(s)</td>
                        <td class="text-center" style="width:20%;"><strong>Tirs</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["tir2"]}} dont {{$value["tircadre2"]}} cadré(s)</td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["possession1"]}} %</td>
                        <td class="text-center" style="width:20%;"><strong>Possession</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["possession2"]}} %</td>
                    </tr> 
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["passe1"]}} ({{$value["passereussi1"]}} % réussies)</td>
                        <td class="text-center" style="width:20%;"><strong>Passes</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["passe2"]}} ({{$value["passereussi2"]}} % réussies)</td>
                    </tr>                             
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["faute1"]}}</td>
                        <td class="text-center" style="width:20%;"><strong>Fautes</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["faute2"]}}</td>
                    </tr>                                                                                     
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["cjaune1"]}}</td>
                        <td class="text-center" style="width:20%;"><strong>Cartons jaunes</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["cjaune2"]}}</td>
                    </tr>       
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <td class="text-center" style="width:40%;">{{$value["crouge1"]}}</td>
                        <td class="text-center" style="width:20%;"><strong>Cartons rouges</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["crouge2"]}}</td>
                    </tr>     
                    <tr>
                        <td class="text-center" style="width:40%;">{{$value["distance1"]}} kms</td>
                        <td class="text-center" style="width:20%;"><strong>Distance parcourue</strong></td>
                        <td class="text-center" style="width:40%;">{{$value["distance2"]}} kms</td>
                    </tr>                                                                                                                                     
                    </table>                                            
                @else
                    <span class = "text-success"><strong>Le match n'a pas débuté</strong></span>
                @endif
            </div>
        </div>                              
        <br>
    </p>
    @php ($i++)
@endforeach 
</form>