<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }} - Admin</title>
<link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">

<link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/calendar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')
