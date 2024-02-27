<!doctype html>
<html lang=""{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ Session::get('layout') == 'rtl' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Management System</title>
    <link rel="shortcut icon" href="{{ asset('assets/landing/images/logo/favicon.svg') }}" type="image/svg+xml" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/plugin' . Helper::rlt_ext() . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style' . Helper::rlt_ext() . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables' . Helper::rlt_ext() . '.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app' . Helper::rlt_ext() . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.min.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="{{ asset('assets/css/material-icons.css') }}">
    <style>
        .no-border {
            border: 0;
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
            background-color: #fff !important;
            color: #545454 !important;
            border: 1px solid #7455F7 !important;
            padding: 8px 30px !important;
        }

        .swal2-confirm {
            padding: 10px 30px !important;
        }
    </style>
    @yield('style')
</head>
