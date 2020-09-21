@extends('layouts.master')
    @section('content')

    <div style="margin-top:5px;">
        <div class="row justify-content-center">
            <div class="form-group mx-sm-3 mb-2">
                <select name="table" class="form-control" id="table-to-work-select">
                    @foreach($tables as $current_table_name)
                        <option value="{{ $current_table_name }}">{{ $current_table_name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary mb-2" onclick="callComparison()" id="comparison-button">
                Compare Table
            </button>
        </div>
        <hr></hr>
        <div id="columns_buttons"></div>

        <div class="row" style="margin-top:30px;">
            <!-- Table representing local data (Left) -->
            <div class="col-6" style="overflow: auto;" >
                <div id="local-table-container" class="comparison-tables-background">
                    <div id="local-table-status" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 678px;">
                        <h1>Local Tables</h1>
                    </div>
                </div>
            </div>
            <!-- Table representing data obtained from external Database (Left) -->
            <div class="col-6" style="overflow: auto;" >
                <div id="external-table-container" class="comparison-tables-background">
                    <div id="external-table-status" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 678px;">
                        <h1>Incoming Tables</h1>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <style>
        .comparison-tables-background{
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            background-color: #f8f8f8;
            min-height: 420px;
            max-height: 420px;
            overflow-y: scroll;
        }

        .column-button-margin {
            margin-right: 2px;
        }

    </style>

    <script type="application/javascript" src="{{ URL::asset('js/comparison.js') }}"></script>

@stop