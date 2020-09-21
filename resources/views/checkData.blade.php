@extends('layouts.master')
    @section('content')
    
    <!-- The controller returns this view and it also returns a $data variable containing all the tables name and their columns -->
    @php
        $tables_name = array_keys($data);
    @endphp 

    <!-- This section shows a heading for the current page and a button that asks for a view containing the data specified -->
    <div class="row" style="margin-top: 40px;"> 
        <div class="col-3"></div>
        <div class="col">
            <div class="col">
                <h3>Apply Rules for checking data</h3>
            </div>
            <hr></hr>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary" onclick="sendRules();" id="request-selected-rules-button" disabled>Apply Selected Rules</button>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 20px;">
    <!-- This column renders all the tables names coming from $tables_name variable -->
        <div class="col-2">
            <div class="loaded-tables-container">
                    <h6>Tables</h6>
                    <hr></hr>
                <div class="list-group" id="">
                    @foreach($tables_name as $current_table_name)
                        <button
                            class="list-group-item list-group-item-action"
                            id="{{ $current_table_name }}"
                            onclick="displayColumnsFromClickedTable(this.id)">
                            {{ $current_table_name }}
                        </button>
                    @endforeach
                </div> 
            </div>
        </div>

        <!-- This column is the container in wich all the columns from the previous clicked table will be rendered   -->
        <div class="col-2" style="">
            <div class="columns-container" id="columns-container"></div>  
        </div>

        <!-- This column is the container in wich all the rules applicable to the selected column will be displayed  -->
        <div class="col-2">
            <div class="rules-container">
                <h6>Rules</h6>
                <hr></hr>
                <div class="list-group" id="rule-options"></div> 
            </div>
        </div>

    </div>

    <!-- Hidden form for making the post request of the specified rules  -->
    <form action="/postCheckData" method="POST" id="post-rules">
        @csrf
        <input type="hidden" name="Data" value="">
    </form>


    <!-- Modal that helps to set the data to operate with the rules -->


    <style>
        .loaded-tables-container{
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            background-color: #ECECEC;
            min-height: 450px;
            max-height: 450px;
            overflow-y: scroll;
        }
        .columns-container{
            width:100%;
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            min-height: 450px;
            max-height: 450px;
            overflow-y: scroll;
        }
        
        .rules-container{
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            background-color: #ECECEC;
            min-height: 450px;
            max-height: 450px;
            overflow-y: scroll;
        } 
    </style>

    <script >

$("#step1").addClass("active");
$("#step2").addClass( "active");
$("#step3").addClass( "active");
$("#step4").removeClass( "active");

            //it creates a JS variable with the php $data variable returned from the controller
            var tables = {!! json_encode($data) !!};
            var tables_name = Object.keys(tables);

            //Options enabled for being rendered as rules on the view
            var ruleOptionsInt = ["Menor que", "Mayor que", "Igual que", "Diferente de"]
            var ruleOptionsVarchar = ["Equal Text", "Different Text", "Include Text"]

            //Symbols that represents the rules and to be used as parameters on the controllers
            var symbolsInt = ["<", ">", "=", "<>" ]
            var symbolsVarchar = ["0", "1", "2"]

    </script>

    <script type="application/javascript" src="{{ URL::asset('js/checkData.js') }}"></script>






@stop