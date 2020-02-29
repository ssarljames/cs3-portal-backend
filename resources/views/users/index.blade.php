<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>
    <a href="/users/create">New</a>
    <table>
        <thead>
            <th>ID</th>
            <th>Username</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                </tr>
            @endforeach
        </tbody>

        {!! $users->links() !!}


    </table>
</body>
</html>
