<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>S.I.I</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }
            #tecmx{
          position: absolute;
            width: 8%;
            align-items: left;
            left:18%;
            top: 4%;
                      }
          #conacyt{
          position: absolute;
            width: 15%;
            align-items: left;
            left:2%;
            top: 27px;
                      }

            .title {
                font-size: 94px;
                color: gray;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
      <div class="container">
        <div class="" >
          <img id="conacyt" src="/logos/tecmx.png" alt="">
          <img id="tecmx"  src="/logos/ittg.jpg"  alt="">

      </div>

        <div class="flex-center position-ref full-height"   >
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">INICIO</a>
                    @else
                        <a href="{{ route('login') }}">INICIAR SESIÓN</a>
                        <a href="{{ route('register') }}">REGISTRARSE</a>
                    @endauth
                </div>
            <div class="content">
                <div class="title m-b-md">
                  SISTEMA INTERNO
                </div>

            </div>
        </div>
        </div>
    </body>
</html>
