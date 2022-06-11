<!DOCTYPE html>
<html>
<head>
    <title>Είσοδος</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      label.error {
          color: #dc3545;
          font-size: 14px;
      }
    </style>
</head>
<body>
<div class="container mt-4">
  @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">Είσοδος</div>
    <div class="card-body">
      <form name="loginform" id="loginform" method="post" action="{{ route('check') }}">
       @csrf
        <div class="form-group">
          <label for="username">'Ονομα Χρήστη:</label>
          <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
          <span class class="text-danger">@error('username'){{ $message }} @enderror</span>
        </div>
        <div class="form-group">
          <label for="password">Κωδικός:</label>
          <input type="password" id="password" name="password" class="form-control">
          <span class class="text-danger">@error('password'){{ $message }} @enderror</span>     
        </div>
        <button type="submit" class="btn btn-primary">Καταχώρηση</button>
      </form>
    </div>
  </div>
</div>  
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>  
<script>
    $(document).ready(function() {
      $("#loginform").validate({
        rules: {
          username: {
              required: true,
              maxlength: 20,
              minlength: 4,
          },
          password: {
              required: true,
              maxlength: 70,
              minlength: 7,
          },
        },
        messages: {
          username: {
              required: "Το Όνομα Χρήστη είναι υποχρεωτικό",
              maxlength: "Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες",
              minlength:  "Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες",
          },
          password: {
              required: "Ο κωδικός είναι υποχρεωτικός",
              maxlength: "Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες",
              minlength: "Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες",
          },
        }
      });
    });
  </script>
</body>
</html>