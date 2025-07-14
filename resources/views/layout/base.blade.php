<!DOCTYPE html>
<html lang="fr" data-theme="light"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css'])
  <title> @yield("title","Eat&Drink") </title>
</head>
<body class="min-h-screen bg-gray-900 text-white">
    <main class="w-[80%] mx-auto">
        @yield('header')
        @yield('content')
        @yield('footer')
    </main>
</body>
</html>