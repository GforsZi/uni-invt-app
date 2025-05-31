<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
<div class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="../index2.html"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>UNI-</b>INVT</h1>
          </a>
        </div>
        <div class="card-body login-card-body">
        @if(session()->has("errorLogin"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Error: {{session("errorLogin")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="/system/login" method="post">
            @csrf
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" placeholder="" />
                <label for="email">Email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
              @error('email')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="" />
                <label for="password">Password</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
              @error('password')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <div class="social-auth-links text-center mb-3 d-grid gap-2">
            <p>- OR -</p>
          </div>
          <!-- /.social-auth-links -->
          <p class="mb-0">
            <a href="/register" class="text-center"> Register a new account </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
</div>
    <script
    src="{{asset('/js/auth.js')}}"
    type="text/javascript"
    charset="utf-8"></script>
</x-guest-layout>