<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @vite('resources/js/main.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dot-gradient {
            background-image: radial-gradient(#212121 20%, transparent 20%), radial-gradient(#212121 20%, transparent 20%);
            background-color: #ffffff;
            background-position: 0 0, 50px 50px;
            background-size: 100px 100px;
        }
        .diagonal-transparent {
            background: linear-gradient(to bottom left, rgba(0, 0, 0, 0.267), rgba(255, 192, 203, 0), rgba(255, 192, 203, 0));
        }
        .fade-in{
            opacity: 0;
        }
        .slide-top-down{
            transform: translateY(100px);
        }
    </style>
</head>
<body>
    <div name="timeline_item" class="container-fluid">
        <div class="row mx-5 my-2 bg-dark bg-opacity-10 border border-top-0 border-end-0 border-4 border-dark rounded-3 fade-in">
            <div class="col-lg-1 d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-circle fade-in"></i>
            </div>
            <div class="col-lg-11 overflow-hidden">
                <span name="timeline_title" class="fs-2 ps-2 fw-bolder d-block fade-in">_title</span>
            </div>
            <div class="col-lg-1 d-flex justify-content-center align-items-center overflow-hidden">
                <div class="vr" style="width: 5px !important; opacity: 1;"></div>
            </div>
            <div class="col-lg-11">
                <span name="timeline_subtitle" class="fs-4 ps-2 fw-bolder text-muted d-block fade-in">_subtitle</span>
            </div>
            <div class="col-lg-1 d-flex justify-content-center align-items-center overflow-hidden">
                <div class="vr" style="width: 5px !important; opacity: 1;"></div>
            </div>
            <div class="col-lg-11">
                <span name="timeline_description" class="fs-4 ps-2 fw-bolder text-muted d-block fade-in">_description</span>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <script type="module" src="{{ Vite::asset('resources/js/anime_test.js') }}"></script>
</body>
</html>
