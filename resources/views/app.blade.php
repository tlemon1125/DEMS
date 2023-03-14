<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap"
      rel="stylesheet"
    />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
    @inertiaHead
  </head>
  <body class="font-sans antialiased">
    @inertia
  </body>
</html>