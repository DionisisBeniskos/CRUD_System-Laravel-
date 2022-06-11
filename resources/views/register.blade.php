<!DOCTYPE html>
<html>
<head>
    <title>Φόρμα Εγγραφής</title>
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
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

  @if(session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
  <div class="card">
    <div class="card-header text-center font-weight-bold">
    Φόρμα Εγγραφής
    </div>
    <div class="card-body">
      <form name="registerform" id="registerform" method="post" action="{{ route('save') }}">
       @csrf
       <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="active" value="yes"/>
            <label class="form-check-label" for="flexCheckDefault">Ενεργός</label>
          </div>
        </div>
        <div class="form-group">
          <label for="fullname">Ονοματεπώνυμο</label>
          <input type="text" name="fullname" class="form-control" >
        </div>
        <div class="form-group">
          <label for="username">'Ονομα Χρήστη:</label>
          <input type="text" name="username" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="password">Κωδικός:</label>
          <input type="password" id="registration_password" name="password" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="confirmPassword">'Επανάληψη Κωδικού:</label>
          <input type="password" name="confirmPassword" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="checkbox">Δικαιώματα:</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role1"/>
            <label class="form-check-label" for="flexCheckDefault">Τεχνικός διαχειριστής</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role2"/>
            <label class="form-check-label" for="flexCheckDefault">Διαχειριστής χρηστών και συνδρομών</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role3"/>
            <label class="form-check-label" for="flexCheckDefault">Διαχειριστής ερωτημάτων/απαντήσεων</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role4"/>
            <label class="form-check-label" for="flexCheckDefault">Διαχειριστής περιεχομένου</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role5"/>
            <label class="form-check-label" for="flexCheckDefault">Διαχειριστής νομολογίας - νομοθεσίας</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="role6"/>
            <label class="form-check-label" for="flexCheckDefault">Διαχειριστής ενημερωτικών δελτίων και νέων</label>
          </div>
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
      $("#registerform").validate({
        rules: {
          fullname: {
              required: true,
              maxlength: 30,
              minlength: 4,
          },
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
          confirmPassword: {
              required: true,
              maxlength: 70,
              minlength: 7,
              equalTo: "#registration_password",
          },
          email: {
              required: true,
              email: true,
              minlength: 5,
              maxlength: 40
          },
        },
        messages: {
          fullname: {
              required: "Το Ονοματεπώνυμο είναι υποχρεωτικό",
              maxlength: "Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες",
              minlength: "Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες",
          },
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
          confirmPassword: {
              required: "Η επανάληψη κωδικού είναι υποχρεωτική",
              maxlength: "Η επανάληψη κωδικού πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες",
              minlength: "Η επανάληψη κωδικού πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες",
              equalTo: "Η επανάληψη κωδικού πρέπει να είναι ίδια με των Κωδικό",
          },
          email: {
              required:  "Το email είναι υποχρεωτικό",
              email: "Παρακαλώ εισάγετε μία έγκιρη διεύθυνση email",
              maxlength: "To email να περιέχει από 5 μέχρι 40 χαρακτήρες"
          },
        }
      });
    });
  </script>
</body>
</html>