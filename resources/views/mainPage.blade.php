@extends('layouts.master')

@section('content')


    <div class="row justify-content-center mainContainer" style="margin-top: 60px;">


    
        <!-- Column for selecting a database from system -->
        <div class="col-2">
            <h5>Choose a Data Base</h5>
                <div class="form-group">
                    <select class="form-control" id="database-names-select">
                        <option selected="true" disabled="disabled">Select Data Base</option>
                    </select>
                </div>
                <!-- Hidden post that calls /resetPresentacionBD route for cleaning the views and hash columns from the previous comparison  -->
                <form method="POST" action="/resetPresentacionBD">
                    <button type="submit" class="btn btn-danger float-left">Reset Data</button>
                </form>
        </div>

        <!-- Column for displaying tables from database selected on the previous column -->
        <div class="col-2">
            <h5 style="color:#dddddd;" id="display-selected-table-name">Choose Tables From Data Base</h5>
            <!-- This div loads all the tables from the selected database with an onclick function that allows them to be selected -->
            <div class="list-group tables-list-background" id="tables-list-container" style=" max-height: 350px;"></div>                
        </div>



        <!-- Column for resuming the selected tables from the previous column -->
        <div class="col-3">
        <div class="resume-table-background">
            <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Selected Tables</th>
                        </tr>
                    </thead>
                    <tbody id="table-body-of-resume-table">
                    </tbody>
            </table>
        </div>

            <br>
            <!-- This button calls a function for posting all the selected tables the next controller -->
            <button id="nextPage" type="button" class="btn btn-primary float-right disabled" onclick="postSelectedTables()" >Choose Operation</button>
        </div>

        <!-- This form is hidden and allows the view to post the tables with the function of the above button -->
        <form action="/chooseMode" method="POST" id="post-tables-form">
            @csrf
            <input type="hidden" name="Data" value="">
        </form>
    </div >

    <!-- <div class="toast" data-autohide="false" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
      <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                    <rect fill="#007aff" width="100%" height="100%" /></svg>
      <strong class="mr-auto">Exception</strong>
      <small class="text-muted">SAT</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
    </div>
    <div class="toast-body">
      Mensaje Test Exception
    </div>
  </div> -->

    <style>
        .resume-table-background{
            border-radius: 5px;
            border: 1px solid #dddddd;
            padding: 20px;
            max-height: 350px;
            overflow-y: scroll;
        }

        .tables-list-background{
            max-height: 500px;
            overflow-y: scroll;
        }
        .mainContainer{
            background-color: white;
        }
    </style>

<script type="application/javascript" src="{{ URL::asset('js/mainPage.js') }}"></script>


@stop