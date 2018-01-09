window.addEventListener("load",function(){
    var modal = document.getElementById('myModal');
    var close= document.getElementById("close");
    var parent= document.querySelector(".masonry");
    var yes= document.getElementById("yes");
    var no =document.getElementById("no");
    var current_item=null;
    parent.addEventListener("click",function(e){
       if(e.target.matches(".myBtn")) {
           current_item =e.target.parentNode.parentNode.parentNode;
           yes.dataset.id = current_item.dataset.id;
           modal.style.display='block';

       }
       yes.addEventListener("click",function () {
          var id=this.dataset.id;
           $.post("/video/api/delMyVideo",{id:id},function (f) {
               current_item.remove();
               modal.style.display="none";
           })
       });
    });
    close.addEventListener("click",function () {
        modal.style.display="none";
    });
    no.addEventListener("click",function () {
        modal.style.display="none";
    });
    window.onclick = function(e){
        if(e.target  == modal){
            modal.style.display="none";
        }
    };


});
