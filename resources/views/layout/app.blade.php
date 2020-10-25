<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/tailwind.css")}}">
</head>
<body>
    <div id="app" class="w-full h-full">
        @yield('content')
        
    </div>
    <script src="{{asset("js/app.js")}}"></script>

</body>
</html>