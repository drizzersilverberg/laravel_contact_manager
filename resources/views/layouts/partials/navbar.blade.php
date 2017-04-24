<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand text-uppercase" href="#">
            My contact
          </a>
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav">
                    <li class="{{ Request::segment(1) == 'home' ? 'active' : "" }}"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="{{ Request::segment(1) == 'contacts' ? 'active' : "" }}"><a href="{{ route('contacts.index') }}">Contacts</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

          @if (! Auth::guest())

            {!! Form::open(['route' => 'contacts.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
              
              <div class="input-group">
                {!! Form::text('term', Request::get('term'), ['class' => 'form-control', 'placeholder' => 'Search...', 'id' => 'term']) !!}              
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
            {!! Form::close() !!}

          @endif
        </div>
      </div>
    </nav>