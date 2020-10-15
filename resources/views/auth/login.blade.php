<!DOCTYPE html>
<html lang="es">
<!--begin::Head-->
<head><base href="../../../../">
  <meta charset="utf-8"/>
  <title>{{ getenv('APP_NAME') }} | Iniciar Sesión</title>
  <meta name="description" content="Iniciar sesión"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>        <!--end::Fonts-->
  <!--begin::Page Custom Styles(used by this page)-->
  <link href="/metronic/assets/css/pages/login/classic/login-3.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <!--end::Page Custom Styles-->
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="/metronic/assets/plugins/global/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/metronic/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/metronic/assets/css/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <link href="/metronic/assets/css/themes/layout/header/base/light.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/metronic/assets/css/themes/layout/header/menu/light.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/metronic/assets/css/themes/layout/brand/dark.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/metronic/assets/css/themes/layout/aside/dark.css?v=7.0.6" rel="stylesheet" type="text/css"/>        <!--end::Layout Themes-->
  <link rel="shortcut icon" href="/metronic/assets/media/logos/favicon.ico"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
  <!--begin::Main-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
      <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(/metronic/assets/media/bg/bg-1.jpg);">
        <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
          <!--begin::Login Header-->
          <div class="d-flex flex-center mb-15">
            <a href="#">
              <img src="/metronic/assets/media/logos/logo-letter-9.png" class="max-h-100px" alt=""/>
            </a>
          </div>
          <!--end::Login Header-->
          <!--begin::Login Sign in form-->
          <div class="login-signin">
            <div class="mb-20">
              <h3>Iniciar sesión</h3>
              <p class="opacity-60 font-weight-bold">Escribe tus datos de acceso</p>
            </div>
            <form class="form" id="kt_login_signin_form" method="post" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="text" placeholder="Nombre de usuario" name="username" autocomplete="off"/>
              </div>
              <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="password" placeholder="Contraseña" name="password"/>
              </div>
              <div class="form-group text-center mt-10">
                <button id="kt_login_signin_submit" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3" type="submit">Entrar</button>
              </div>
            </form>
          </div>
          <!--end::Login Sign in form-->
          <!--begin::Login Sign up form-->
          <div class="login-signup">
            <div class="mb-20">
              <h3>Sign Up</h3>
              <p class="opacity-60">Enter your details to create your account</p>
            </div>
            <form class="form text-center" id="kt_login_signup_form">
              <div class="form-group ">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="text" placeholder="Fullname" name="fullname"/>
              </div>
              <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off"/>
              </div>
              <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password"/>
              </div>
              <div class="form-group">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="password" placeholder="Confirm Password" name="cpassword"/>
              </div>
              <div class="form-group text-left px-8">
                <div class="checkbox-inline">
                  <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                    <input type="checkbox" name="agree"/>
                    <span></span>
                    I Agree the <a href="#" class="text-white font-weight-bold ml-1">terms and conditions</a>.
                  </label>
                </div>
                <div class="form-text text-muted text-center"></div>
              </div>
              <div class="form-group">
                <button id="kt_login_signup_submit" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3 m-2">Sign Up</button>
                <button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white font-weight-bold opacity-70 px-15 py-3 m-2">Cancel</button>
              </div>
            </form>
          </div>
          <!--end::Login Sign up form-->
          <!--begin::Login forgot password form-->
          <div class="login-forgot">
            <div class="mb-20">
              <h3>Forgotten Password ?</h3>
              <p class="opacity-60">Enter your email to reset your password</p>
            </div>
            <form class="form" id="kt_login_forgot_form">
              <div class="form-group mb-10">
                <input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off"/>
              </div>
              <div class="form-group">
                <button id="kt_login_forgot_submit" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3 m-2">Request</button>
                <button id="kt_login_forgot_cancel" class="btn btn-pill btn-outline-white font-weight-bold opacity-70 px-15 py-3 m-2">Cancel</button>
              </div>
            </form>
          </div>
          <!--end::Login forgot password form-->
        </div>
      </div>
    </div>
    <!--end::Login-->
  </div>
  <!--end::Main-->
  <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
  var KTAppSettings = {
    "breakpoints": {
      "sm": 576,
      "md": 768,
      "lg": 992,
      "xl": 1200,
      "xxl": 1400
    },
    "colors": {
      "theme": {
        "base": {
          "white": "#ffffff",
          "primary": "#3699FF",
          "secondary": "#E5EAEE",
          "success": "#1BC5BD",
          "info": "#8950FC",
          "warning": "#FFA800",
          "danger": "#F64E60",
          "light": "#E4E6EF",
          "dark": "#181C32"
        },
        "light": {
          "white": "#ffffff",
          "primary": "#E1F0FF",
          "secondary": "#EBEDF3",
          "success": "#C9F7F5",
          "info": "#EEE5FF",
          "warning": "#FFF4DE",
          "danger": "#FFE2E5",
          "light": "#F3F6F9",
          "dark": "#D6D6E0"
        },
        "inverse": {
          "white": "#ffffff",
          "primary": "#ffffff",
          "secondary": "#3F4254",
          "success": "#ffffff",
          "info": "#ffffff",
          "warning": "#ffffff",
          "danger": "#ffffff",
          "light": "#464E5F",
          "dark": "#ffffff"
        }
      },
      "gray": {
        "gray-100": "#F3F6F9",
        "gray-200": "#EBEDF3",
        "gray-300": "#E4E6EF",
        "gray-400": "#D1D3E0",
        "gray-500": "#B5B5C3",
        "gray-600": "#7E8299",
        "gray-700": "#5E6278",
        "gray-800": "#3F4254",
        "gray-900": "#181C32"
      }
    },
    "font-family": "Poppins"
  };
  </script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="/metronic/assets/plugins/global/plugins.bundle.js?v=7.0.6"></script>
  <script src="/metronic/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6"></script>
  <script src="/metronic/assets/js/scripts.bundle.js?v=7.0.6"></script>
  <!--end::Global Theme Bundle-->
</body>
<!--end::Body-->
</html>