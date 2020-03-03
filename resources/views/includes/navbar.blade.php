 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container">
         <a class="navbar-brand" href="/">HillGamers</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav my-2 my-lg-0">
                 <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                     <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item {{ Request::is('staff') ? 'active' : '' }}">
                     <a class="nav-link" href="{{ route('staff') }}">Staff</a>
                 </li>

                 @auth
                 @if(!Auth::user()->isVip())
                 <li class="nav-item {{ Request::is('vip') ? 'active' : '' }}">
                     <a class="nav-link" href="{{ route('vip') }}">Vuelvete VIP</a>
                 </li>
                 @endif

                 <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                     <a class="nav-link" href="/profile">
                         {{ Auth::user()->realname }}
                         @if(Auth::user()->isVip())
                             <span class="badge badge-primary">VIP Member</span>
                         @endif
                     </a>
                 </li>
                 @endauth
                 @guest
                 <li class="nav-item {{ Request::is(route('login')) ? 'active' : '' }}">
                     <a class="nav-link" href="{{ route('login') }}">Iniciar sesi&oacute;n</a>
                 </li>
                 @endguest

             </ul>

         </div>
     </div>
 </nav>
