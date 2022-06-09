<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nice Places</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/6259f9b52f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="app">
        </div>
         <script>
           window.Laravel = <?php echo json_encode([
               'csrfToken' => csrf_token(),
                    ]); ?>
          </script>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>