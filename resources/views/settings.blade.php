<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
{!! Form::open([ 'route' => 'team.new', 'method'=>'POST', 'class'=> 'form-horizontal']) !!}
<div class="form-group">
    <input type="text" name="team_name" placeholder="Team name">
</div>
<div class="form-group">
    <input type="submit">
</div>
{!! Form::close() !!}
</body>
</html>