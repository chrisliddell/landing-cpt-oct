$(document).ready(function(){
	
//responsive
$(window).resize(function() {
	var width = $(window).width();
	if (width < 1200){
		$("#bolso").css("display", "none");
	} else {
		$("#bolso").css("display", "flex");
	}
});
  

//solo permitir numeros en cedula, telefono y edad
function testInput(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[0-9]/i);
   return pattern.test(value);
}
$('#telefono').bind('keypress', testInput);


  
// Metodo de cpt 
$(document).on("click","#participar",function(){
  
    var nombre = $.trim($("#nombre-completo").val());
    var telefono = $.trim($("#telefono").val());
    var correo = $.trim($("#correo").val());
	var regEx = /\S+@\S+\.\S+/; //para validar correo

	if( (nombre != "")&&(telefono != "")&&(correo != "")&&(empresa != "")&&(productos != "") ){
		//validar el correo
		if(regEx.test(correo)){
			//validar telefono
			regEx = /[0-9]/;
			if(regEx.test(telefono)){
				var datos = $("#promocion").serialize();
				 //Registro en base de datos
				$.ajax({
					type : "POST",
					url : "registroCupon.php",
					data : datos,
					beforeSend: function(){
						$("#mensaje").html("Enviando...");
						$("#mensaje").fadeIn("fast");
					},
					success : function (data) {	
						$.ajax({
							type : "POST",
							url : "contact.php",
							data : datos,
							beforeSend: function(){
								$("#mensaje").html("Enviando...");
								$("#mensaje").fadeIn("fast");
							},
							success : function (data) {          
								$("#mensaje").html("Recibido, gracias por sus datos");      

								setTimeout(function(){
									$("#mensaje").html("");
									$("#mensaje").fadeOut("fast");
									location.href = "";
									$("#promocion")[0].reset();
								},3500);
							}
						});	
					}
				});
			}else{
				$("#telefono").css("border","1px solid red");
				$("#mensaje").html("Teléfono inválido.");  
				$("#mensaje").fadeIn("fast");            
				setTimeout(function(){
					$("#telefono").css("border","0 none");
					$("#mensaje").fadeOut("fast");    
					$("#mensaje").html("");
				},3000);
			}
		}else{ 
			$("#correo").css("border","1px solid red");
			$("#mensaje").html("Correo inválido.");  
			$("#mensaje").fadeIn("fast");            
			setTimeout(function(){
				$("#correo").css("border","0 none");
				$("#mensaje").fadeOut("fast");    
				$("#mensaje").html("");
			},3000);
		} 
	}else{
		$("#nombre-completo").css("border","1px solid red");
		$("#telefono").css("border","1px solid red");
		$("#correo").css("border","1px solid red");
		$("#empresa").css("border","1px solid red");
		$("#productos").css("border","1px solid red");
		$("#mensaje").html("Los campos en rojo son obligatorios");  
		$("#mensaje").fadeIn("fast");            
		setTimeout(function(){
			$("#nombre-completo").css("border","0 none");
			$("#telefono").css("border","0 none");
			$("#empresa").css("border","0 none");
			$("#productos").css("border","0 none");
			$("#correo").css("border","0 none");
			$("#mensaje").fadeOut("fast");    
			$("#mensaje").html("");
		},3000);
	}
});

});