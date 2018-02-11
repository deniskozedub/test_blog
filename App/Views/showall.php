<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"
      xmlns="http://www.w3.org/1999/html">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <a class="btn btn-primary" href="<?=URLROOT?>posts">Add post</a>
            <a class="btn btn-primary" href="<?=URLROOT?>posts/showtop">See top posts</a>
            <div class="panel panel-default">
                <div style="text-align: center" class="panel-heading">
                    <b >There are all posts</b>
                </div>
                <div class="panel-body">
                    <div>
                        <?php foreach ($posts as $post):?>
                            <div>
                                <a class="link" href="<?=URLROOT?>posts/showone/<?=$post["id"]?>"><?=$post["title"]?></a><br>

                            <time><?=$post["time"]?></time> by <b><?=$post["authors_name"]?></b>
                            <ul class="blockquote-reverse">
                            <?php foreach ($coments as $item):?>
                                <?php if($post['id'] == $item['post_id']) :?>
                                    <li class="form-control"><?=$item["com"]?></li>
                                <?php endif;?>
                            <?php endforeach;?>
                            </ul>
                            <form method="POST" action="<?=URLROOT?>posts/addcomment">
                                <input type="hidden" name="id" value="<?=$post["id"]?>">
                                <input type="text" name="com" placeholder="your comment">
                                <input class="btn-primary" type="submit" value="Add Comment">
                            </form>
                            <hr>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







