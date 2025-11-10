@extends('layouts.app-login')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h4 class="mb-4 text-center">Masuk ke SIMPUS</h4>
          @if(session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
          @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" required autofocus>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ingat saya</label>
              </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
              
            </div>

            <button class="btn btn-primary w-100">Masuk</button>
          </form>
        </div>
      </div>
      {{-- Optional: info footer --}}
    </div>
  </div>
</div>
@endsection
