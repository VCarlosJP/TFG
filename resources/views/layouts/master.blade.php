<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
                <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
        </script>

        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

 



<link rel="stylesheet" type="text/css" href="{{ url('/css/steps.css') }}" />
    </head>
    <body>

    <!-- NavBar -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Proyecto Sistema de Alerta Temprana</span>
    </nav>




    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Rule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <label for="staticEmail2" class="sr-only">Ingresar Valor a Operar</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Ingresar Valor a Operar">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="input-to-operate" class="sr-only">Ingresar Valor a Operar</label>
                            <input type="text" class="form-control" id="input-to-operate" placeholder="Ej: 4">
                        </div>
                        <div id="mayus"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="applyRule();">Add Rule</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Apply Rule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <label for="staticEmail2" class="sr-only">Ingresar Valor a Operar</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail22" value="Ingresar Valor a Operar">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="input-to-operate" class="sr-only">Ingresar Valor a Operar</label>
                            <input type="number" class="form-control" id="input-to-operate2" placeholder="Ej: 4">
                        </div>
                        <div id="mayus"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="applyRule();">Add Rule</button>
                </div>
            </div>
        </div>
    </div>

    <div class='container-fluid mainContainer'>

            <div class="myContainer" style="min-height: 100%; width: 95%; background-color: white;">

                <div class="containerV">
                    <ul class="progressbarV">
                        <li id="step1">Establecer Tablas</li>
                        <li id="step2">Selección Módulo</li>
                        <li id="step3">Preparación</li>
                        <li id="step4">Operación</li>
                        
                </ul>
            
            </div>
            <hr style="margin-top: 110px;">
            <div class="container-fluid" >
            @yield('content')
            </div>
        </div>
    
        


    </body>


    <!-- Navbar
    <form class="form-inline my-2 my-lg-0">
            <a  class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="load_main_content()">Ejecutar Analisis</a>
    </form> -->
</html>
