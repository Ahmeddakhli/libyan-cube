<!-- SEO -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{$unit->title}}</title>

<link rel="shortcut icon" href="{{URL::asset('/front/images/logo.png')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap">

<link rel="stylesheet" href="{{URL::asset('/front/landing/css/splitting.css')}}" />
<link rel="stylesheet" href="{{URL::asset('/front/landing/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/front/landing/css/bootstrap-select.css')}}">
<link rel="stylesheet" href="{{URL::asset('/front/landing/css/jquery.fancybox.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/front/landing/css/slick.css')}}">
<link rel="stylesheet" href="{{URL::asset('/front/landing/css/style.css')}}">
<style>
nav.chat {
    position: fixed;
    bottom: 1rem;
    right: 2rem;
    z-index: 17;
}
.chat #chat__input {
    display: none;
}
.chat #chat__input:checked ~ a.chat__zoom {
    -webkit-transform: translate(-50%, -45px);
    -ms-transform: translate(-50%, -45px);
    transform: translate(-50%, -45px);
    opacity: 1;
    z-index: 1;
}
.chat #chat__input:checked ~ a.chat__whatsapp {
    -webkit-transform: translate(-50%, -90px);
    -ms-transform: translate(-50%, -90px);
    transform: translate(-50%, -90px);
    opacity: 1;
    z-index: 1;
}
.chat .chat__btn {
    display: block;
    margin: 0 -0.3rem 0 0;
    cursor: pointer;
}
.chat .chat__btn img {
    width: 2.5rem;
    -webkit-filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.3));
    filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.3));
}
.chat a.chat__zoom,
.chat a.chat__whatsapp {
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    opacity: 0;
    z-index: -1;
    -webkit-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
.chat a.chat__zoom img {
    width: 2.3rem;
}
.chat a.chat__whatsapp img {
    width: 2rem;
}
</style>

<!-- ION ICON (LIBRARY OF ICONS) -->
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>

<link href="{{URL::asset('8x/assets/vendors/custom/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Custom Styles -->
<link rel="stylesheet" href="{{URL::asset('/front/css/additional.css')}}">
