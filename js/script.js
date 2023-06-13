$("#delete-product").on("click", function(e){
    e.preventDefault();
    if(confirm("Are you confirm"))
    {
        var frm = $("<form>");
        frm.attr('method','post');
        frm.attr('action',$(this).attr('href'));
        frm.appendTo("body");
        frm.submit(); 
    }
}); 

