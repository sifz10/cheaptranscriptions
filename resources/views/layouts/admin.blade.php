<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Cheaptranscriptions Dashboard</title>



    <!-- Bootstrap core CSS -->
   <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
     <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin">Cheaptranscriptions</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>

      </ul>
    </nav>

    <div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/admin">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/awsjobs">
              <span data-feather="file-text"></span>
              AWS Queue
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/plans">
              <span data-feather="file-text"></span>
              Create Plans
            </a>
          </li>

        </ul>

      </div>
    </nav>



		@yield('content')
      </div>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  	<script src="/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="/js/jquery.validate.min.js"></script>


    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>



  </body>
</html>
