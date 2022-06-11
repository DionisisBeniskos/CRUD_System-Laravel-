<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-3 justify-content-around">
                <h2>Πίνακας Χρηστών</h2>
                <a  class="btn btn-secondary " href="{{ route('logout')}}">Αποσύνδεση</a>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Όνομα</th>
                    <th scope="col">Όνομα Χρήστη</th>
                    <th scope="col">Ρόλοι</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$user['fullname']}}</td>
                        <td>{{$user['username']}}</td>
                        <?php $roles = json_decode($user->roles); ?>
                        <td><?php echo $str = implode(', ', $roles); ?></td>
                        <td>
                            <a href="{{ url('editUser'.$user->id) }}" class="btn btn-success">Επεξεργασία</a>
                            <a href="{{ url('deleteUser'.$user->id) }}" class="btn btn-danger">Διαγραφή</a>
                        </td>
                        </tr>
                    @endforeach      
                </tbody>
            </table>
        </div>
    </body>
</html>