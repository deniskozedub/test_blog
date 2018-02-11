<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <form class="form-control col-md-4" method="post" action="<?=URLROOT?>posts/add">
            <textarea class="form-control" type="text" name="title" placeholder="body"></textarea>
        <input class="form-control" type="text" name="name" placeholder="name">
        <input class="btn btn-success" type="submit" value="Add">
        </form>
    </div>
</div>
</body>
</html>