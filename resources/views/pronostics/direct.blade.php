@extends('layouts.app')

@section('content')

        <div class = "row" style = "margin-top:50px;">
            <div class="col-12 d-block mx-auto">
                <div class="card ">

                    <div class="card-header text-center alert-info"><h3>M@rranel Info</h3>
                        <i class="text-center" style = "font-size:12px">Informations très techniques sur les matchs</i>
                    </div>                    


                    <div class="card-body ">

                        <div class = "text-center mb-3">
                            <div id="buttonChoix" class="btn-group btn-group-toggle text-center" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="options" id="direct" autocomplete="off" checked> Direct
                                </label>                                
                                <label class="btn btn-secondary ">
                                    <input type="radio" name="options" id="historique" autocomplete="off"> Historique
                                </label>
                            </div>
                        </div>

                        <div id="infoStat">

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript')
<script>

    $.get('pronostic/direct', function( data ) {
        $('#infoStat').html( data );
    });

    $("#buttonChoix :input").change(function() {
        element = this.id;
        $.get('pronostic/'+element, function( data ) {
            $('#infoStat').html( data );
        });
    });

  
</script>
@endsection