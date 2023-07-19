<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expandx</title>
</head>
<style>
      table {
         border:1px solid black;
         margin-left:auto;
         margin-right:auto;
      }
      th, td{
         border:1px solid black;
         padding: 20px;
      }
      h1{
        text-align: center;
      }
      </style>
<body>
<div class="container">
        <h1>Students Data</h1>
        <table>
                <thead style="ml-20">
                    <tr>
                        <th class="">Student Name</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pin Code</th>
                        <th>Profile Image</th>
                    </tr>
                </thead>
                <tbody>
        @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->state->name }}</td>
                        <td>{{ $student->city->name }}</td>
                        <td>{{ $student->pin_code }}</td>
                        <td><img src="{{ asset('Images/' . $student->profile_image) }}" alt="Profile Image" width="100"></td>
                    </tr>
        @endforeach
                </tbody>
        </table>
    </div>
</body>
</html>