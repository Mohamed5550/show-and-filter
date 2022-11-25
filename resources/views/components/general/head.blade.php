<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <title>{{ $title }}</title>

    {{-- For CSRF  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- For search js submit --}}
    <meta name="search-route" content="{{ route('products.search', true) }}"/>
    <script src="{{ asset('js/main.js') }}"></script>
</head>