<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1>
        <thead>
            <th>Date</th>
            <th>User</th>
            <th>Session Start</th>
            <th>Session End</th>
            <th>Total Time (Mins)</th>
        </thead>
        <tbody>
            @foreach ($printer_usage_logs as $log)
                <tr>
                    <td>{{ $log->start->format('M d, Y') }}</td>
                    <td>{{ $log->user->username }}</td>
                    <td>{{ $log->start->format('h:i A') }}</td>
                    <td>{{ $log->end ? $log->end->format('h:i A') : '-'}}</td>
                    <td>{{ $log->total_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
