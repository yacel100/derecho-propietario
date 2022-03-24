@if(Auth::user())
@extends('adminlte::auth.register')
@else 
  <script>window.location = "/login";</script>
  exit();
@endif

