@extends('layouts.app')

@section('title', 'Konsultasi Home | PKBI CARE')

@section('content')
  <div class="pt-[100px] bg-gray-100">
    @livewireScripts
    @livewireStyles
    <livewire:konsultasi.lists />
  </div>
@endsection
