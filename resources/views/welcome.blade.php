<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        {{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.min.css">--}}
        <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
    <body>
        <div class="container" id="app">
            <div class="row>">
                <div class="col-md-10">
                    <csv-parser button-text="Import&hellip;" :show-path="true" table-height="20em"></csv-parser>
                </div>
            </div>
        </div>
        <script src="{{ elixir('js/main.js') }}"></script>
    </body>
</html>
