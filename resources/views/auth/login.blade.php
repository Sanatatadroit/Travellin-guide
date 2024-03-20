<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Transparent Login Form HTML CSS</title>
      <link rel="stylesheet" href="{{ URL::asset('assets/login_css/style.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Login Form</header>
            <form method="POST" action="{{ route('login') }}">
               @csrf
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input id="email" name="email" type="text" required placeholder="Email or Phone">
               </div>
               @error('email')
               <div class="text-danger">{{ $message }}</div>
               @enderror
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" id="password"  name="password" class="pass-key" required placeholder="Password">
                  <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>                  
               </div>
               @error('password')
               <div class="text-danger">{{ $message }}</div>
               @enderror
               <div class="pass">
                  <input id="remember_me" type="checkbox" class="remember">
                  <span class="remember">{{ __('Remember me') }}</span>
                  @if (Route::has('password.request'))
                  <a  href="{{ route('password.request') }}">Forgot Password?</a>
                  @endif
               </div>
               <div class="field">
                  <input type="submit" value="LOGIN">
               </div>
            </form>
            <div class="signup">
               Don't have an account?
               <a href="{{ route('register') }}">Signup Now</a>
            </div>
         </div>
      </div>
      <script>
         document.querySelectorAll('.toggle-password').forEach(function(element) {
            element.addEventListener('click', function() {
               const input = document.querySelector(this.getAttribute('toggle'));
               if (input.getAttribute('type') === 'password') {
                  input.setAttribute('type', 'text');
               } else {
                  input.setAttribute('type', 'password');
               }
            });
         });
      </script>
   </body>
</html>
