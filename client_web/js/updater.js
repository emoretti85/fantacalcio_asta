$( document ).ready(function() {
	
	
});

function refreshPageData() {
	console.log("Tento un refresh");
	$.ajax({
		  type: 'POST',
		  dataType: "json",
		  url: 'core/refresh_ajax.php',
		  data: {idStanza: stanza_id, idAdmin: user_id },
		  beforeSend:function(){
		  },
		  success:function(data){
			 
				  $("#creaStanza").hide();
				  $("#accediStanza").hide();
				  $("#iniziaAsta").show();
				  $("#sidebar-header-h5").html("Connesso alla stanza: "+ data["nome_stanza"] +"<br/>Id stanza: "+stanza_id);
				  
				  $("#panel_user_connected_body").html("");
				  $.each(data["utenti_connessi"], function() {
				        $.each(this, function(k,v) {
				            $("#panel_user_connected_body").append("<i class='fa fa-user' aria-hidden='true'></i> "+v+"<br/>");
				        });
				    });
				  $("#panel_user_connected").show();
				  
				  console.log("refresh");

		  },
		  error:function(){
			  console.log("abort refresh");
			  abortTimer();
		  }
		});
}

function abortTimer() {
	  clearInterval(refresh_id);
}