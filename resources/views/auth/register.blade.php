<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jankos Glow Marketing Competition</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style type="text/css">
        *, *:after, *:before {
         box-sizing: border-box;
         padding: 0;
         margin: 0;
         font-family: sans-serif;
         }
         body {
         min-height: 100vh;
         background-color: #fff;
         }
         .grid {
         display: grid;
         grid-template-columns: 1fr 1fr;
         height: auto;
         }
         .order__left {
         order: 1;
         padding:  40px;
         }
         .order__right {
         order: 2;
         }
         .centered {
         display: flex;
         align-items: center;
         justify-content: center;
         }
         .no__overflow {
         display: flex;
         align-items: center;
         overflow: hidden;
         }
         .form {
         max-width: 500px;
         }
         .logo {
         margin-bottom: 12px;
         }
         h4 {
         color: #867992;
         text-align: left;
         margin-bottom: 30px;
         letter-spacing: 0.2px;
         line-height: 20px;
         }
         input[type=text], input[type=password], input[type=email], input[type=number] {
         width: 100%;
         padding: 12px 16px;
         margin: 16px 0;
         display: block;
         border: 1px solid #c8c3cf;
         border-radius: 4px;
         box-sizing: border-box;
         background-color: #F6F5F7;
         font-size: 16px;
         color: #4F4659;
         outline: none;
         transition: box-shadow 0.25s ease-in-out,  background-image 0.25s;
         }
         input[type=text]:focus, input[type=password]:focus {
         border-color: #A26ED4;
         background: #FAF8FD;
         background: #FDFCFE;
         box-shadow: 0 0 0 0.25rem #ebd6ff;
         }
         ::-webkit-input-placeholder {
         color: #A29CA8;
         }
         :-ms-input-placeholder {
         color: #A29CA8;
         } ::placeholder {
         color: #A29CA8;
         }
         .justify__space_between {
         display: flex;
         align-items: center;
         justify-content: space-between;
         margin: 30px 0 26px 0;
         }
         input[type=checkbox], label {
         margin-right: 4px;
         cursor: pointer;
         outline-color: #B595D4;
         }
         .remember_me, .signup {
         color: #867992;
         }
         .forgot__password {
         color: #551A8B;
         text-align: left;
         outline-color: #B595D4;
         }
         .forgot__password:active {
         color: #867992;
         }
         .login__button {
         outline-color: #734E96;
         width: 100%;
         border: none;
         background-color: #A26ED4;
         padding: 13px 17px;
         color: #fff;
         border-radius: 0.25rem;
         font-size: 16px;
         cursor: pointer;
         transition: box-shadow 0.25s ease-in-out, background-color 0.3s;
         }
         .login__button:hover {
         box-shadow: 0 0 0 0.25rem #DAC5EE;
         }
         .login__button:active {
         background-color: #874DBF;
         box-shadow: 0 0 0 0.35rem #DAC5EE;
         }
         .signup {
         font-size: 14px;
         text-align: center;
         margin-top: 32px;
         }
         .img {
         height: 100%;
         width: 100%;
         object-fit: cover;
         max-width: auto;
         }
         @media only screen and (max-width:  800px) {
         .grid {
         grid-template-columns: auto;
         height:auto;
         }
         .order__left {
         order: 2;
         padding: 20px;
         }
         .order__right {
         order: 1;
         }
         .centered {
         align-items: flex-start;
         }      
         .no__overflow {
         align-items: flex-start;
         }
         h4 {
         text-align: center;
         }
         .img {
         width: 100%;
         height: 100%;
         }
         @media only screen and (max-width:  400px) {
         .grid {
         grid-template-columns: auto;
         height:auto;
         }
         
         }
         
         @media only screen and (max-height:  600px) {
        .grid {
         grid-template-columns: auto;
         height:auto;
         }
         .img {
         width: 100%;
         height: 100%;
         }
         }
    </style>
    
    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-list-view.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/wizard.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pickadate@5.0.0-alpha.3/builds/index.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
    <!-- END: Page CSS-->
</head>
<body>
<div id="app">
    
         <div class="grid">
         <div class="order__left centered">
            <div class="form">
               <div class="logo">
                  <!-- <a href="{{route('home')}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 530.59 103.21" class="h-6 w-auto">-->
                  <!--  <g id="Layer_2" data-name="Layer 2">-->
                  <!--    <g id="Layer_1-2" data-name="Layer 1">-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M390.8,43.23c.62-1.64,1.34-3.3,1.93-4.81a109.2,109.2,0,0,0,3.82-11.28c1.34-5,2.77-11.28,2.6-16.49,0-.92-.29-4.61-1.59-4.84-.64-.11-1.41.72-1.76,1.15a14.25,14.25,0,0,0-2.19,4.52c-2.5,8.06-3.18,20.3-2.9,28.78Zm30.1,12.29c-1,1.52-2,3.27-2.52,4.07-1.34,2-2.64,4.1-4.06,6.1-3.36,4.71-9.23,11.46-15.83,9.85-8.27-2-12.28-15.65-13.67-22.88-2.34-12.21-2.7-42.13,7.58-50.75A7.78,7.78,0,0,1,400.81.74c2.69,1.23,3.84,3.83,4.13,6.66,1,9.49-3.89,23.91-8.08,32.39a45.25,45.25,0,0,1-3.81,6.53,15.17,15.17,0,0,0-1.66,2.46c-.43,1.09.06,3.61.23,4.74.7,4.57,2.15,10.6,5.3,14.07,3.82,4.21,8.69,3.29,12.24-.69,3.19-3.59,5.7-8.05,8.41-12s5.6-7.58,9.53-10.17c3.31-2.17,14.08-5.09,17-1.43l.39.48-2.6,3.41h-.4c-2.84-.06-8.09-.79-10.59.53a5.73,5.73,0,0,0-2.51,3,17.24,17.24,0,0,0-1,8.57c.7,5.91,4.89,14.93,12.21,11a6.42,6.42,0,0,0,.93-.6A9,9,0,0,0,442.79,67a14.1,14.1,0,0,0,1.67-5.16c.06-.52.18-2.47-.22-2.87a8.74,8.74,0,0,0-2.48-.74c-8.36-2.46-4-12.67,2.11-8a13.06,13.06,0,0,1,3,3.5,15.19,15.19,0,0,0,4.22-1.41c1.13-.52,2.23-1.09,3.32-1.69a7.82,7.82,0,0,1,2-.94l.77,0,0,.77c-.16,4.1-5.3,6.69-8.84,7.85.56,4.94-.25,9.64-3.62,13.51s-7.88,5.64-12.92,4.36c-4.43-1.13-7.52-4.4-9.41-8.42A19.74,19.74,0,0,1,420.9,55.52Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M230.92,58.39a12,12,0,0,0-2.18-5.32c-4.21-5.34-7.43-.74-3.45,3.26a8.63,8.63,0,0,0,5.63,2.06m.34,3.6c-4.14.12-7.72-.45-10.85-3.53-2.76-2.72-4.35-8.7-.95-11.58s8.68-1,11.6,1.45c2.56,2.17,4.15,5.88,4.85,9.21a19.18,19.18,0,0,0,6.14-4l1.41-1.32-.08,1.93c-.13,3.27-4.23,5.44-7,6.64.06,5-.82,10.95-4.4,14.68-3,3.14-7.2,3.9-11.38,3.45-4.54-.5-7.83-3.48-9.94-7.37S208.42,64.7,208.37,61c-2,4.1-3.91,7.79-7.3,11.39-3.73,4-8.68,7.24-14.34,5.79-4.76-1.21-8.48-5.4-11-9.4A42.22,42.22,0,0,1,171,58.17c-.41-1.41-1.6-5.67-.22-6.82.82-.69,1.54-1.46,2.42-2.09l.2-.16h.26c2.26,0,3.6,2.88,4.34,4.63,1.24,2.91,2.15,6,3.26,9,2.7,7.18,6.35,14.26,14.89,9.06,3.1-1.89,5.45-5,7.25-8.1a74.5,74.5,0,0,0,4.58-9.89c.64-1.61,2-5.32,3.15-6.51l.21-.21.28,0c1.38-.13,3,0,3.85,1.23,1.9,2.6-1,7.6-.34,10.38l0,.13v.12c-.33,4,.35,8.09,2.86,11.33a8.57,8.57,0,0,0,1,1,7.61,7.61,0,0,0,4.94,2C229.54,73.25,231.06,66.62,231.26,62Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M159.39,64.1c4-7.65,8.38-14.88,15.77-19.91,3.88-2.64,11.94-5.9,16.08-2.33,2.62,2.26.74,6-.79,8.34-1,1.53-2.81,3.36-4.85,2.54S182.75,49,183.7,47c-2.93-.55-7.64,2.19-9.65,3.53-2.76,1.82-5.38,5.24-7.25,8a63.76,63.76,0,0,0-6.09,12.06c-.91,2.2-2.34,6.12-4.77,7a3.91,3.91,0,0,1-2.32.06l-.36-.09-.16-.33c-1.67-3.49,1.53-29.63,1.86-35.55.35-6.22.66-12.44.76-18.67.06-3.72-.67-16.18.6-18.78.59-1.21,2.17-2.63,3.58-2.62,3.68,0,3.28,10.3,3.35,12.81.34,11.86-.95,24.46-2.18,36.27-.27,2.61-.66,5.21-1,7.81-.25,1.82-.51,3.72-.67,5.61"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M519.18,51.68c3.45.13,6.87-1.3,9.86-2.87l1.55-.81-.41,1.7c-1.19,5-8.2,6.89-12.66,7.77a49.54,49.54,0,0,1-5.78,12.63c-2.33,3.56-7.3,9.19-12.05,6.3-3.3-2-5.54-8.46-7.1-11.94-.3-.67-2.09-4.72-3-4.73s-3.25,4.08-3.67,4.77c-.94,1.54-1.87,3.1-2.86,4.61-1.95,3-5.2,7.58-9.08,7.94s-6.54-3.37-8.21-6.25c-2.85-4.93-11.69-27.83.32-27.06l.63,0,.1.61c.77,4.56,1.37,9,2.41,13.51.43,1.84,3.17,14.25,6.82,12,1.8-1.1,4.1-4.95,5.24-6.81s2.19-3.78,3.46-5.6c2.54-3.65,6.78-8,10.56-2.91,2.57,3.49,5.45,14.33,8.47,16,.9.49,3.23-2.5,3.63-3.06A34.9,34.9,0,0,0,512.07,58c.7-2.24.37-1.44-.78-3.17-3-4.48-.46-11.82,5.45-10.72l.26,0,.18.2a8.35,8.35,0,0,1,2,7.33"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M247.91,71.62c2-.21,7.18,2,9.47,2.55s8.73,1.74,9.9-1.58c.72-2-1.08-4.35-2.59-5.52a78,78,0,0,0-7.4-4.55c-5.39-3.25-12.34-8.34-4.9-14.07,3.35-2.58,16-5.9,19.53-3l.23.18.05.29a3.21,3.21,0,0,1-.5,2.59c-1.56,2-6.49,1.42-8.78,1.39h-1.18c-2.22,0-7.57,1.36-5.81,4.62.72,1.34,7.72,5,9.28,5.85a45.9,45.9,0,0,1,6.2,4c2.56,2.07,4.6,5.29,3.9,8.71-.84,4.06-4.9,6-8.64,6.62a22.92,22.92,0,0,1-11.73-1.37c-2.12-.84-7.61-3.33-7.74-5.9l0-.75Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M99.28,56.73l-2.54-3.31C94.13,50,105.38,46,110,59.51c1.07,3.14,2,6.58,3.48,9.53.29.57,1,1.75,1.72,1.78,1.23.06,3.06-2.69,3.64-3.57,1.84-2.76,3.43-5.7,5.27-8.48a32.82,32.82,0,0,1,5.63-6.8c2-1.73,4.66-3.2,7.38-2.37,4.78,1.46,7,9.08,7.84,13.39.57,2.77,2,13,.13,15.34a2.22,2.22,0,0,1-1.93,1c-1.65-.19-2.46-3-2.86-4.29-.76-2.56-1.3-5.24-1.92-7.84-.58-2.43-2-8.69-4.12-10.19a1.8,1.8,0,0,0-1-.37c-1.47,0-3.2,2.05-4,3.09-1.81,2.33-3.38,5-5,7.48-1.92,3-4.6,7.13-7.59,9.11a5.82,5.82,0,0,1-5.06,1c-6.45-2.15-7.42-19.6-12.07-20.59Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M73.84,50.8c-5,1.64-8.56,6.12-10.3,10.92-.9,2.45-2.18,8.39.5,10.23,1.17.81,2.78.36,4-.18,4.06-1.84,7.51-7,9.49-10.89a20.64,20.64,0,0,0,2.4-7.76c.06-3.29-3.84-3-6-2.32m7.65,10.58c-.46,1-.87,2.13-1.36,3.15-2,4.17-4.75,8.56-8.59,11.26-7.11,5-16,3.28-16.71-6.46-.52-7.57,3.29-14.8,9.07-19.52,4.32-3.53,11.49-6.77,16.92-3.89a8.21,8.21,0,0,1,2,1.47,44.86,44.86,0,0,1,3,3.9c1.94,2.36,3.28,8.19,4.14,11.2.8,2.81,2.64,9.65,5.75,10.7A4.07,4.07,0,0,0,99,72.6c.9-.52,2.81-1.47,3.63-.32.53.75.06,1.72-.43,2.35a8.06,8.06,0,0,1-2.59,2.05c-5.4,2.84-10.35,1.4-13.49-3.71a34.34,34.34,0,0,1-3-6.42C82.78,65.67,82.09,63,81.49,61.38Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M51.15,17.17C49.76,26.4,50,35,50.45,44.31c.22,4.46.44,8.91.44,13.37,0,14.38-1,29-12.87,38.84a29.24,29.24,0,0,1-17,6.65c-5.46.29-11.29-1.07-15.37-4.9a14.63,14.63,0,0,1-2.5-3c-4.3-7-3.9-15.2-.88-22.54C3.87,68.88,8.4,61.1,12.88,60.27L14.54,60l-.82,1.47C11,66.32,7.33,71.83,6.29,77.37c-3.95,21.21,19.15,24.54,30.4,10.72,7.37-9,7.49-24.32,7.24-35.43-.07-3.12-.21-6.23-.43-9.35-.15-2.16-.34-4.32-.47-6.48A105.78,105.78,0,0,1,44,18c-3.51-.14-7-.2-10.51-.37-4.1-.2-9.13-.48-13.08-1.62-2.34-.68-5.61-1.31-5-4.55l.1-.53.53-.1A26.52,26.52,0,0,1,22,10.78c1.66.1,3.35.25,5,.28A124.17,124.17,0,0,0,45.28,9.71c2.34-.3,7.93-1.32,9.66.75,1.05,1.27.64,3.18.2,4.6L55,15.4Z"></path>-->
                  <!--      <path class="cls-1" style="fill:#D05559" d="M329.11,56c0,2.43-.05,4.82,0,7.27a83.22,83.22,0,0,0,1.23,12.5c1.35,7.34,4.59,17.47,13.64,17.6,7.88.11,15.77-9.4,19.69-15.33a58.67,58.67,0,0,0,7.23-15c.74-2.51,1.95-7.68.15-10-2.79-3.56-8.91-3.87-13-3.87a48.28,48.28,0,0,0-6.67.65c-6.6,1-16.59,3-22.25,6.16m-7.66-2.78c2-16.16,3.93-27.37,15.56-40,7.23-7.84,20.84-11.24,30.79-8,2.53.83,6.17,2.29,7.84,4.5,1,1.3,1.27,3,0,4.24a3,3,0,0,1-4.48-.11,12.18,12.18,0,0,0-9.46-4.37c-18.18,0-28.31,18.55-31,34.49a29.42,29.42,0,0,0-.76,3.78,22.73,22.73,0,0,1-.4,2.68l5.14-1.8c9.13-3.21,26.83-6.47,35.52-2.27a20.85,20.85,0,0,1,2.07,1.14c5.6,3.47,5.87,10.44,4.32,16.34-2.33,8.85-7.59,16.35-13.38,23.27-.69.83-1.41,1.57-2.16,2.33a45.63,45.63,0,0,1-5,4.22,33.7,33.7,0,0,1-5.81,3.45c-12.57,6-20.76-2-25.06-12.8-3.08-7.71-4-17.12-4.07-25.31l-3.25,1.38c-2.43,1-8.95,6-9.16.81C308.59,57.68,320.39,55,321.45,53.24Z"></path>-->
                  <!--    </g>-->
                  <!--  </g>-->
                  <!--</svg></a>-->
                </div>

               <h2 class="text-center">
                <a style="color: #A26ED4; text-decoration: none; font-weight:bold;" href="{{route('home')}}">MARKETING TALENT COMPETITION #1</a>
               </h2>
               @if (session('confirmation'))
                    <div class="alert alert-info" >
                        {!! session('confirmation') !!}
                    </div> <br>
                @endif
                @if ($errors->has('confirmation') > 0 )
                    <div class="alert alert-danger">
                        {!! $errors->first('confirmation') !!}
                    </div>
                @endif
                
                <div class="alert alert-dismissible">
                  @include('flash::message')
                </div>
                
                @error('email')
                        <div class="alert alert-success alert-dismissible">
                            <strong>Email yang anda daftarkan telah terdaftar pada sistem kami</strong>
                        </div>
                @enderror
                
                <form class="form-signin" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <input type="text" id="name" name="name" placeholder="Guru Penanggung Jawab" autocomplete="off" required autofocus>
                   @error('name')
                        <span >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <input type="text" id="school" name="school" placeholder="Instansi/ Sekolah" autocomplete="off" required autofocus>
                   @error('school')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <input type="text" id="team" name="team" placeholder="Nama Tim" autocomplete="off" required autofocus>
                   @error('team')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <input type="number" id="phone" name="phone" placeholder="No. Telpon/ Whatsapp" autocomplete="off" required autofocus>
                   @error('phone')
                        <span >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <input type="number" id="norek" name="norek" placeholder="No. Rekening Team" autocomplete="off" required autofocus>
                   @error('norek')
                        <span >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                   <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required autofocus>
                   @error('email')
                        <span >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                                
                   <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required autofocus>
                   @error('password')
                        <span >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                   
                   <button type="submit" class="login__button">Daftar</button>
                </form>
               
               <div class="signup">
                  <label class="remember_me">
                  Sudah punya akun ?</label><a href="{{route('login')}}" class="forgot__password" style="text-decoration: none;"><strong>Masuk Disini.</strong></a>
                  <hr><small style="font-size: 12px;">*setelah melakukan pendaftaran, akun anda akan melalui verifikasi terlebih dahulu sebelum dapat digunakan dalam perlombaan</small>
               </div>

            </div>
         </div><!-- order__left centered -->
         
         <div class="order__right centered no__overflow">
            <img class="img" src="{{asset('images/manual-book-01.jpg')}}" alt="picture">
         </div><!-- order__right centered no__overflow -->

      </div><!-- end grid -->
    
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('js')

<!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-user.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('app-assets/js/scripts/forms/wizard-steps.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</body>
</html>
