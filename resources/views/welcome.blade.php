<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vite - JavaScript bundling -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: rgb(243, 244, 246);
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .navbar-toggler {
            border-color: #dee2e6;
        }

        .navbar-nav .nav-link {
            color: #495057;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            text-align: center;
            padding: 1.5rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .welcome-header {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-message {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #495057;
        }

        .feature-list {
            list-style: none;
            padding-left: 0;
            text-align: left;
            color: #6c757d;
        }

        .feature-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .feature-list li::before {
            content: '\2022';
            position: absolute;
            left: 0;
            color: #007bff;
        }
    </style>
</head>
<body class="antialiased">

<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Task Manager') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-8">
    <h1 class="welcome-header">Welcome to Task Manager!</h1>
    <p class="welcome-message">
        This powerful tool is designed to streamline your project workflows and enhance collaboration.
    </p>

    <ul class="feature-list">
        <li>Intuitive Interface: User-friendly design for a seamless experience.</li>
        <li>Task Creation: Easily create and organize tasks for your projects.</li>
        <li>Progress Tracking: Monitor task completion and overall project progress.</li>
        <li>Collaboration: Foster teamwork by assigning tasks to team members.</li>
        <li>Deadline Management: Set and manage deadlines to stay on schedule.</li>
    </ul>
</div>

</body>
</html>
