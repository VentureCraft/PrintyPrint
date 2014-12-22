
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Chris Duell - VentureCraft">

    <title>VentureCraft Mini Printer</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Printer</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">VenureCraft mini printer</h3>
      </div>

      <div class="jumbotron">
        <h1>Create message</h1>
            {{ Form::open(['route' => 'print.store']) }}
            <div class="row">
            <div class="col-md-12">
            {{ Form::textarea('text', null, ['placeholder' => 'message to print...', 'rows' => '3', 'class' => 'form-control']) }}
            </div>
            <div class="col-md-12">
            {{ Form::submit('Add to queue', ['class' => 'btn btn-success']) }}
            </div>
            </div>
            {{ Form::close() }}
      </div>

      <div class="row marketing">

        <div class="col-lg-6">
          <h4>Queue</h4>
          {{ Notification::showAll() }}

            <table style="width: 100%" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Printed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->created_at}}</td>
                        <td>{{ $post->comment }}</td>
                        <td>{{ $post->printed_at?'Yes':'No'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; VentureCraft {{ date('Y') }}</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
