<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            overflow-x: hidden;
        }
        .content-wrapper {
            margin-left: 250px;
            transition: margin 0.3s ease;
        }
        .app-sidebar.hidden {
            transform: translateX(-250px);
        }
    </style>
</head>
<body>
    @include('components.navbar') <!-- Navbar custom kamu -->
    
    <!-- Menggunakan Sidebar dari AdminLTE -->
    @include('adminlte::components.sidebar') <!-- Sidebar AdminLTE -->

    <div class="content-wrapper">
        @yield('content')
        @yield('scripts')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButton = document.querySelector('[data-lte-toggle="sidebar"]');
            const sidebar = document.querySelector('.app-sidebar');
            const contentWrapper = document.querySelector('.content-wrapper');

            toggleButton.addEventListener('click', function (e) {
                e.preventDefault();
                sidebar.classList.toggle('hidden');
                contentWrapper.style.marginLeft = sidebar.classList.contains('hidden') ? '0' : '250px';
            });
        });
    </script>
</body>
</html>
