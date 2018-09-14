@extends('layouts.app')

@section('content')




        <div class = "row" style = "margin-top:50px;">
            <div class="col-12 d-block mx-auto">
                <div class="card ">
                    <div class="card-header text-center"><h3>Statistiques</h3>
                        <i class="text-center" style = "font-size:12px">Statistiques des matchs qui n'ont pas encore commencé</i>
                    </div>


                    <div class="card-body ">
                        @if(!empty($statistiques))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class= "text-center" >Match</th>
                                        <th class= "text-center" >Groupe</th>
                                        <th class= "text-center" >1</th>
                                        <th class= "text-center">N</th>
                                        <th class= "text-center">2</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php( $i = 1)
                                    @foreach ($statistiques as $statistique)
                                        <tr>
                                            <td class="text-center">{{$statistique->equipe1}} - {{$statistique->equipe2}}  </td>
                                            <td class="text-center">{{$statistique->type}}   </td>
                                            <td class="text-center">{{$statistique->score1}}   </td>
                                            <td class="text-center">{{$statistique->scoreN}}   </td>
                                            <td class="text-center">{{$statistique->score2}}   </td>
                                        </tr>
                                        @php( $i++)
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning text-center" >Pas de statistiques/div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript')
<script>


</script>
@endsection