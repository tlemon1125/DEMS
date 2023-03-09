<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    
    @routes
    @vite(['resources/js/app.jsx'])
    @viteReactRefresh
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>