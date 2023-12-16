<x-guest-layout>
   <section class="login-content">
      <div class="row m-0 align-items-center bg-white vh-100">            
         <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="{{asset('images/auth/05.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
         </div>
         <div class="col-md-6">           
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                     <div class="card-body">
                        <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
                           <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                           </svg>
                           <h4 class="logo-title ms-3">{{env('APP_NAME')}}</h4>
                        </a>
                        <h2 class="mb-2 text-center">{{ __('auth.create_account') }}</h2>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{route('register')}}" data-toggle="validator">
                            {{csrf_field()}}
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="full-name" class="form-label">{{ __('auth.first_name') }} <span class="text-danger">*</span></label>
                                    <input id="name"  name="first_name" value="{{old('first_name')}}" class="form-control" type="text" placeholder=" "  required autofocus >
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="last-name" class="form-label">{{ __('auth.last_name') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" placeholder=" " value="{{old('last_name')}}" required>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="username" class="form-label">{{ __('auth.user_name') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" required>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                       <label>{{ __('auth.email') }} <span class="text-danger">*</span></label>
                                       <input class="form-control" type="email" placeholder=" " id="email"  name="email" value="{{old('email')}}" required>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="password" class="form-label">{{ __('auth.password') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" placeholder=" " id="password" name="password" required autocomplete="new-password" >
                                    <small>Mínimo de 8 caracteres</small>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="confirm-password" class="form-label">{{ __('auth.confirm_password') }} <span class="text-danger">*</span></label>
                                    <input id="password_confirmation" class="form-control" type="password" placeholder=" " name="password_confirmation" required >
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary"> {{ __('auth.sign_up') }}</button>
                           </div>
                           <p class="mt-3 text-center">
                              {{ __('auth.already_have_an_account') }}  <a href="{{route('login')}}" class="text-underline">{{ __('auth.sign_in') }}</a>
                           </p>
                        </form>
                     </div>
                  </div> 
               </div>
            </div>    
            <div class="sign-bg sign-bg-right">
               <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g opacity="0.05">
                  <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                  <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                  <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                  <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                  </g>
               </svg>
            </div>
         </div>   
      </div>
   </section>
</x-guest-layout>
