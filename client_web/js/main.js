$( document ).ready(function() {
   
	var refresh_id = null;
	var refresh_millisec = 5000;
	var user_id = null;
	var stanza_id= null;
	

	$("#panel_user_connected").hide();
	$("#iniziaAsta").hide();
	
	
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
		
	
	$("#accediStanzaForm").submit(function(e){
		$.ajax({
			  type: 'POST',
			  dataType: "json",
			  url: 'core/accediStanza.php',
			  data: { idStanza: $("#idStanza").val(), idAdmin: $("#idUtente").val() },
			  beforeSend:function(){
			  },
			  success:function(data){
				 
					  $("#accediStanzaModal").modal('toggle');
					  $("#creaStanza").hide();
					  $("#accediStanza").hide();
					  $("#iniziaAsta").show();
					  $("#sidebar-header-h5").append("Connesso alla stanza:"+ data["nome_stanza"] +"<br/>Id stanza: "+$("#idStanza").val());
					  
					  $.each(data["utenti_connessi"], function() {
					        $.each(this, function(k,v) {
					            $("#panel_user_connected_body").append("<i class='fa fa-user' aria-hidden='true'></i> "+v+"<br/>");
					        });
					    });
					  $("#panel_user_connected").show();
					  
					  user_id = $("#idUtente").val();
					  stanza_id = $("#idStanza").val();
					  refresh_id = setInterval(refreshPageData, refresh_millisec);
			  },
			  error:function(){
				  $("#messaggio_AccediStanza").html("<p style='text-align:center;color:red;'>Bevi de meno e metti l'id giusto!</p>");				
			  }
			});
		 e.preventDefault();
	});
	
	$("#creaStanzaForm").submit(function(e){
		
		$.ajax({
			  type: 'POST',
			  dataType: "json",
			  url: 'core/creaStanza.php',
			  data: { nomeStanza: $("#nomeStanza").val(), idAdmin: $("#idUtente").val() },
			  beforeSend:function(){
			  },
			  success:function(data){
				  
				  $("#creaStanzaModal").modal('toggle');
				  $("#creaStanza").hide();
				  $("#accediStanza").hide();
				  $("#iniziaAsta").show();
					  
				  $.each(data["utenti_connessi"], function() {
				        $.each(this, function(k,v) {
				            $("#panel_user_connected_body").append("<i class='fa fa-user' aria-hidden='true'></i> "+v+"<br/>");
				        });
				    });
				  $("#panel_user_connected").show();
				  
				  user_id = $("#idUtente").val();
				  stanza_id = data["id_stanza"];
				  $("#sidebar-header-h5").append("Connessi alla stanza:"+ $("#nomeStanza").val() +"<br/>Id stanza: "+stanza_id);
				  refresh_id = setInterval(refreshPageData, refresh_millisec);
			  },
			  error:function(){
				  $("#messaggio_creaStanza").html("<p>"+data+"</p>");
			  }
			});
		 e.preventDefault();
	});
	
	$("#iniziaAstaForm").submit(function(e){
		
	});
	 
});