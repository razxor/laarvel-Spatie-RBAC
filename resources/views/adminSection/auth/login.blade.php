{{-- resources/views/admin/auth/login.blade.php --}}
@extends('adminSection.layouts.masterAdminLayout') {{-- or a separate admin layout if you prefer --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white shadow rounded-2xl p-8">
    <h1 class="text-2xl font-bold text-center mb-6">Admin Login</h1>

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
               class="mt-1 w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password" required
               class="mt-1 w-full border rounded-lg px-3 py-2 @error('password') border-red-500 @enderror">
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6 flex items-center">
        <input id="remember" name="remember" type="checkbox" class="mr-2">
        <label for="remember" class="text-sm text-gray-700">Remember me</label>
      </div>

      <button type="submit" class="w-full rounded-lg px-4 py-2 font-semibold bg-blue-600 text-white">
        Log in
      </button>
    </form>
  </div>
</div>
@endsection
