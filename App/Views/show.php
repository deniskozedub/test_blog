<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div style="text-align: center" class="panel-heading">
                    <b> <h2>There are 5 top pospt</h2></b>
                </div>
                <div class="panel-body">
                        <?php foreach ($posts as $post):?>
                    <div class="blockquote-reverse">
                        <blockquote><?=$res = substr($post["title"],0,100)?></blockquote>
                        <time><?=$post["time"]?></time> by <b><?=$post["authors_name"]?></b>
                        <hr>
                    </div>
                        <?php endforeach;?>

                    <form class="form-control col-md-6 col-md-offset-2" method="post" action="<?=URLROOT?>posts/add">
                        <textarea class="form-control" type="text" name="title" placeholder="body"></textarea>
                        <input class="form-control" type="text" name="name" placeholder="name">
                        <input class="btn btn-success" type="submit" value="Add">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-info" href="<?=URLROOT?>posts/showall">To Home Page</a>

</div>



