<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="flex-center w-100 h-100">
        <form @yield("form-attributes")>
            @yield("inputs")
            @yield("button")
        </form>
    </div>
</body>
</html>