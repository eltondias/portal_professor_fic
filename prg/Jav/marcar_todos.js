function marcardesmarcar(){
   if ($("#todos").attr("checked")){
      $('.MARCAR').each(
         function(){
            $(this).attr("checked", true);
         }
      );
   }else{
      $('.MARCAR').each(
         function(){
            $(this).attr("checked", false);
         }
      );
   }
}