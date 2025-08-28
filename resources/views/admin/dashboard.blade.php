{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    <p class="mt-4">You are logged in as <strong>{{ auth()->user()->name }}</strong>.</p>

    <form method="POST" action="{{ route('admin.logout') }}" class="mt-6">
      @csrf
      <button class="rounded-lg bg-gray-800 text-white px-4 py-2">Logout</button>
    </form>
  </div>
@endsection
