$("#delete-product").on("click", function(e){
    e.preventDefault();
    if(confirm("Are you confirm"))
    {
        // alert("delete the article")
        var frm = $("<form>");
        frm.attr('method','post');
        frm.attr('action',$(this).attr('href'));
        frm.appendTo("body");
        frm.submit(); 
    }
}); 

