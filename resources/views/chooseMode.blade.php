@extends('layouts.master')
    @section('content')

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 60px;">
        <div class="row">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <form action="/checkData" method="POST" id="check-data-form">
                        @csrf
                        <i class='fas fa-clipboard-check' style='font-size:48px;'></i>
                        <h5 class="card-title mt-2">Check Data Status</h5>
                        <input type="hidden" name="Data" value="">
                        <button type="submit" class="btn btn-primary">Check It</button>
                    </form>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <form action="/assembleDatabase" method="POST" id="compare-data-form">
                        @csrf
                        <i class='fas fa-not-equal' style='font-size:48px;'></i>
                        <h5 class="card-title mt-2">Compare Data</h5>
                        <input type="hidden" name="Data" value="">
                        <button type="submit" class="btn btn-primary">Compare Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $( document ).ready(function() {
            var tables = {!! json_encode($tables) !!};
            $('#check-data-form [name="Data"]').val(JSON.stringify(tables));
            $('#compare-data-form [name="Data"]').val(JSON.stringify(tables));

            $("#step1").addClass("active");
            $("#step2").addClass( "active");
            $("#step3").removeClass( "active");
            $("#step4").removeClass( "active");

        });
    </script>

@stop