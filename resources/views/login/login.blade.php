<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
      <div class="container main">
          <div class="row">
              <div class="col-md-6 side-image">
                  <img src="image/logo.png" alt="">
              </div>
              <div class="col-md-6 right">
                  <div class="input-box">
                     <header>Login</header>
                     @if ($errors->any())
                         <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                         </div>
                     @endif
                     <form action="#" method="POST" id="loginForm">
                        @csrf
                        <div class="input-field">
                            <input type="text" class="input" id="email" required="" name="email" value="">
                            <label for="email">Email</label> 
                        </div>                         
                     <div class="input-field">
                          <input type="password" class="inputpassword" id="pass" required="" name="password">
                          <label for="pass">Password</label>
                      </div>
                      <div class="lupapassword">
                        <a href="/lupapassword">Lupa Password?</a>
                       </div>
                     <div class="input-field">
                          <input type="submit" class="submit" value="Login" onclick="submitform()">
                     </div> 
                    </form>
                  </div>  
              </div>
          </div>
      </div>
  </div>

  <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>