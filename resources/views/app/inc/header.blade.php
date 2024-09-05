<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inferninho</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('app/css/style.css') }}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  </head>
<div class='pre-loader'>
  <img class='loading-gif' alt='loading' src="{{ URL::asset('app/images/logo.png') }}"/>
  <i class="fa-solid fa-spinner"></i>
</div>