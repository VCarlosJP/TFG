@extends('layouts.master')
    @section('content')

    @if (count($data) == 0)
        
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">No matched data</th>
            </tr>
        </thead>
    </table>


    @else

    @php
        $newData = (array) $data[0];
        $newDataKeys = array_keys($newData);
        $arrayKeysNew = array_keys((array) $data);
        $parsedData = (array) $data;
        $datax = false;

    @endphp 
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
                <th scope="col">#</th>
            @foreach($newDataKeys as $column_name)
                <th scope="col">{{ $column_name }}</th>
            @endforeach
          </tr>
        </thead>

        <tbody>

            @foreach($arrayKeysNew as $index)
            <tr>
                <th scope="row">{{ $index }}</th>
                @foreach(get_object_vars($parsedData[$index]) as $response)
                    <td>{{ $response }}</td>
                @endforeach
                
            </tr>
            @endforeach
        </tbody>
 
      </table>

      @endif

    <script type="application/javascript" src="{{ URL::asset('js/checkDataResults.js') }}"></script>
@stop