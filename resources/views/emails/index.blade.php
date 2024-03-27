<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mail</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
 
</head>

<body>
    
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ asset('image/mail.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text text-center">Un mail a été envoyé dans votre boîte de réception.</p>
                    </div>
                    <div class="card-footer"> <a href="/" class="btn btn-outline-dark" >Revenir à l'accueil </a></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
