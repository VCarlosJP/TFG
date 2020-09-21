@extends('layouts.master')

@section('content')

    <!-- The controller returns this view and it also returns a $data variable containing all the tables name and their columns -->
    @php
        $tables_name = array_keys($data);
    @endphp 

    <!-- This section shows a heading for the current page and a button that calls the next view/controller -->
    <!-- <div class="row" style="margin-top: 40px;"> 

        <div class="col-4">
            <button type="submit" class="btn btn-primary" onclick="postSelectedColumns()">Compare Tables</button>
        </div>
    </div> -->

    <div class="row justify-content-center" style="margin-top: 20px;">
    <!-- This column renders all the tables names coming from $tables_name variable -->
        <div class="col-2">
            <div class="loaded-tables-container">
                <h4>Selected Tables</h4>
                <hr></hr>
                <div class="list-group" id="">
                    @foreach($tables_name as $current_table_name)
                        <button
                        class="list-group-item list-group-item-action"
                        id="{{ $current_table_name }}"
                        onclick="displayColumnsFromClickedTable(this.id)">{{ $current_table_name }}
                        </button>
                    @endforeach
                </div> 
            </div>
        </div>
        <!-- This column renders all the columns from the current selected table with a checked status -->
        <div class="col-4" style="">
            <h4 id="selected-table-heading">Columns from</h4>
            <p>*Select the <b>columns</b> to ignore in the comparison</p>

            <div class="form-check" >
                <input class="form-check-input" type="checkbox" value="" id="uncheck-all-columns" disabled>
                <label class="form-check-label" for="uncheck-all-columns">
                    Uncheck all the columns
                </label>
            </div>
            
            <div class="columns-container" id="columns-container">
            </div>   
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary" onclick="postSelectedColumns()">Compare Tables</button>
        </div>
        <!-- The hidden form returns all the tables with all their columns that were diselected to be ignored -->
        <form action="/setDataToCompare" method="POST" id="post-ignored-tables-form">
                @csrf
                <input type="hidden" name="Data" value="">
        </form>
    </div>

    <style>
        .loaded-tables-container{
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            background-color: #ECECEC;
            min-height: 500px;
            max-height: 500px;
            overflow-y: scroll;
        }
        .columns-container{
            width:70%;
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            min-height: 400px;
            max-height: 400px;
            overflow-y: scroll;
        }     
    </style>

    <script >
            //it creates a variable with the php $data variable returned from the controller
            var tables = {!! json_encode($data) !!};
            var tables_name = Object.keys(tables);

            $("#step1").addClass("active");
$("#step2").addClass( "active");
$("#step3").addClass( "active");
$("#step4").removeClass( "active");
    </script>

    <script type="application/javascript" src="{{ URL::asset('js/selectKey.js') }}"></script>



    @stop