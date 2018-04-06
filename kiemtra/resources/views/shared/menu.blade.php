<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
<a class="navbar-brand" href="{{ route("class.index") }}">Student Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbars">
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}" href="{{ url('/') }}">
          <a class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'personal.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('personal.index') }}">Student List</a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'class.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('class.index') }}">Class</a>
        </li>
      </ul>
    </div>
  </nav>