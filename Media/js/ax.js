(function () {
    var view,fade,inp_name,inp_addr,submit,form,but_del;

  /*  function createPagination(page,pagecount) {
        var $ul = $("<ul class='pagination'>");
        if(page>1) $ul.append("<li data-page='1'>&lt;&lt;</li>")
        for(i=page-4;i<page;i++){
            if(i>0) $ul.append("<li data-page='"+i+"'>"+i+"</li>")
        }
        $ul.append("<li class='active'>"+page+"</li>")
        for(i=page+1; i<page+4 && i<=pagecount;i++){
            $ul.append("<li data-page='"+i+"'>"+i+"</li>")
        }
        if(page<pagecount) $ul.append("<li data-page='"+pagecount+"'>&gt;&gt;</li>")
        return $ul;
    }*/
    function createVideoView(video){
       return `<div class="post_box">
        <h2><a href="`+video.url+`">`+ video.name+`</a></h2><button data-type="del" data-id="`+ video.id+`">Удалить</button>
        <button data-type="edit" data-id="`+ video.id+`" >Редактировать</button>
    </div>`;

    }

    function showAll(video) {
        view.empty();
        for(let i in video){
            view.append(createVideoView(video[i]));
        }
    }
    function getVid(id) {
        //fade.show();
        $.post("/video/api/admin",{id:id},function (response) {
           // alert(response)
            var video = JSON.parse(response);
            showAll(video);
            //fade.hide();
        })
    }

    function delVid(id) {
        $.post("/video/api/AdminDelVideo",{id:id},function (r) {
        })
    }
    function editVideo(id) {
        $.post("/video/api/GetId",{id:id},function (r) {
            var video = JSON.parse(r);
            inp_name.value= video.name;
            inp_addr.value= video.url;
            submit.dataset.id=video.id;

        })

    }
    function saveVideo(id,name,video) {
        $.post("/video/api/Save/",{id:id,name:name,url:video},function (r) {
                var id = $("select").val();
                getVid(id);
        })

    }
    function delUser(id){
        $.post("/video/api/Del_User/",{id:id},function(res){

        })
    }
    $(document).ready(function () {
        view = $(".ajax_container");
        fade = $(".fade");
        inp_name = document.querySelector("input[name=name]");
        inp_addr = document.querySelector("input[name=addr]");
        submit   = document.querySelector("input[type=submit]");
        form     = document.querySelector(".edit");
        but_del  = document.getElementById('del');

        but_del.addEventListener("click",function(e){
             var id = $("select").val();

             id == 1 ? alert("Вы не можете удалить себя!!!"): delUser(id);

            document.querySelector("option[value='"+id+"']").remove();
            
         })



        //getPage(1);
        submit.addEventListener("click",function (e) {
            saveVideo(e.target.dataset.id,inp_name.value,inp_addr.value);
            form.style.display="none";

        })
        $("select").on("change",function () {
            var id = this.value;
            getVid(id);
        })
        view.on("click",function (e) {

          if(e.target.dataset.type=="del"){
               delVid(e.target.dataset.id);
                e.target.parentNode.remove();
          }
          if(e.target.dataset.type=="edit"){
              editVideo(e.target.dataset.id);
              form.style.display="block";
          }



        })

    })
})();
