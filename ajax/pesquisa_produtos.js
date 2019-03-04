$(document).ready(function(){  
    $('#produto').keyup(function(){  
         let retorno = $(this).val()  
         if(retorno != '')  {  
            $.ajax({  
                    url:"../funcs/search.php",  
                    method:"POST",  
                    data:{retorno:retorno},  
                    success:function(data) {
                        $('#produtoList').fadeIn()  
                        $('#produtoList').html(data)  
                        $("#produtoList li").on('click', function(){ 
                            $('#produto').val($(this).text())  
                            $('#produtoList').fadeOut().change()
                            atualiza_campos() 
                        })  
                    }  
            })  
        }  
    })  
})