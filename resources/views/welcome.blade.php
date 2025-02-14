<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Patient Information System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('laravelCSS/laravel.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet" />
        <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet" />        
        <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet" />       
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <i class="fa-solid fa-hospital-user" style="font-size: 80px;color: #198754;"></i>
                    <label style="margin-top: 5%;font-size: 24px;color: #0dcaf0;">
                        Patient Registration System
                    </label>
                </div>  
                @yield('content')
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        @php
                            if(!empty(Auth::user()->name)){
                                echo 'Department of Health Eastern Visayas Center for Health Development';
                            }
                        @endphp
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        @php
                            if(!empty(Auth::user()->name)){
                                echo Auth::user()->name.' | <a type="button" id="logoutButton">Logout</a>'; 
                            }else{
                                echo 'Department of Health Eastern Visayas Center for Health Development | <a type="button" href="javascript(0)" class="underline text-gray-900 dark:text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login</a>';
                            }
                        @endphp
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            <i class="fa-solid fa-user-lock"></i>
                            Login
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm">
                            <label for="email">
                                <i class="fa-regular fa-envelope"></i> Email:
                            </label>
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control"><br>
                            <label for="password">
                                <i class="fa-solid fa-key"></i> Password:
                            </label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control"><br>
                            <button type="submit" class="btn btn-success form-control">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/terminalscript.js') }}"></script>
    </body>
</html>
