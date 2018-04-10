<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
<a class="navbar-brand" href="{{ route("class.index") }}">Dong A University</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbars">
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}" href="{{ url('/') }}">
          <a class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'personal.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('personal.index') }}">Students</a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'class.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('class.index') }}">Classes</a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'subjects.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('subjects.index') }}">Subjects</a>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'instructors.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('instructors.index') }}">Instructors</a>
        </li>
      </ul>
    </div>
  </nav>