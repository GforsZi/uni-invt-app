<x-guest-layout>
    <x-slot:tittle></x-slot:tittle>
<div class="register-page bg-body-secondary">
    <div class="register-box">
      <!-- /.register-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="../index2.html"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>UNI-</b>INVT</h1>
          </a>
        </div>
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>
          <form action="/system/register" method="post">
            @csrf
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="" />
                <label for="name">Full Name</label>
              </div>
              <div class="input-group-text"><span class="bi bi-person"></span></div>
                @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" />
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
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" />
                <label for="password_confirmation">password confirmation</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
              @error('password_confirmation')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="#">terms</a>
                  </label>
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
            <a href="login.html" class="link-primary text-center"> I already have a membership </a>
          </p>
        </div>
        <!-- /.register-card-body -->
      </div>
    </div>
</div>    
    <script
    src="{{asset('/js/auth.js')}}"
    type="text/javascript"
    charset="utf-8"></script>
</x-guest-layout>