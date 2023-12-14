<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>W20 - Teste técnico</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <main style="height: 100vh; background-color: #CCC">
        <div class="container-fluid py-4 h-100 d-flex align-items-center justify-content-center">
            @yield('content')
        </div>
    </main>
</body>

</html>
