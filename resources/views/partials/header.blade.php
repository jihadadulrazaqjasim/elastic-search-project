<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token() }}">


    <title>{{ config('app.name', 'Elastic Search') }}</title>


    <!-- Custom styles for this template-->


    <link href="{{URL::to('css/sb-admin-2.css')}}" rel="stylesheet">
    <!-- Styles -->
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}
    
    <link rel="stylesheet" href="{{URL::to('css/style.css') }}">
    
    <link rel="stylesheet" href="{{URL::to('vendor/bootstrap/css/bootstrap.css')}}">

    {{-- Template --}}
    
    <!-- Custom fonts for this template-->
    <link href="{{URL::to('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
#page-top {
    background-image: url("{{URL::to('img/bluebackground.jpg')}}");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    opacity: 0.9999;
}


/* 
.nav-link i span{
    color:aqua;
} */
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    
    
</head>