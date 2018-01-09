<?=Helper_HTML::js("event")?>
<div class="row masonry" data-columns>
  
   <?php if(empty($videos)):?>
       <h3>Нет у вас ни одной видеозаписи</h3>
   <?php else: foreach ($videos as $video):?>

         <div class="item" data-id="<?=$video["id"]?>">
        <div class="thumbnail">
           <iframe width="350" height="250" src='<?=$video["url"]?>'
                frameborder="0" allowfullscreen>
           </iframe>
            <div class="caption" style="display: flex;justify-content: space-between;">
                <h3> <?=$video["name"]?></h3>
                <span  class="glyphicon glyphicon-remove myBtn"></span>

            </div>
        </div>
    </div>

    <?php endforeach; endif;?>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="close">&times;</span>
            <p>Удалить видео</p>
            <button id="yes">Да</button>   <button id="no">Нет</button>

        </div>
    </div>
</div>
    <style>
        .modal{
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,.7);
        }
        .modal-content{
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border:1px solid #888;
            width: 50%;
            background: green;
            text-align: center;
        }
        #close{
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;

        }
    </style>





  <nav class="text-center">
<!--<ul class="pagination">

<li class="disabled">
<a href="">
<i class="fa fa-chevron-left"></i>
</a>
</li>
<li class="active"><a href="">1</a></li>
<li>
<a href="">
<i class="fa fa-chevron-right"></i>
</a>
</li>

</ul>-->
      <?=@$pag?>
                </nav> 