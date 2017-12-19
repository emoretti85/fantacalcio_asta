$( document ).ready(function() {
   
	var refresh_id = setInterval(mycode, 2000);
	
	function mycode() {
		$.ajax({
			  type: 'POST',
			  dataType: "json",
			  url: 'core/accediStanza.php',
			  data: { idStanza: $("#idStanza").val(), idAdmin: $("#idUtente").val() },
			  beforeSend:function(){
			    // this is where we append a loading image
			    //$('#ajax-panel-creaStanza').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				 
					  $("#accediStanzaModal").modal('toggle');
					  $("#creaStanza").hide();
					  $("#accediStanza").hide();
					  $(".sidebar-header").append("<h5>Connessi alla stanza:"+ data["nome_stanza"] +"</h5>");
					  
					  $.each(data["utenti_connessi"], function() {
					        $.each(this, function(k,v) {
					            //alert(k + ' ' + v);
					            $("#panel_user_connected_body").append("<i class='fa fa-user' aria-hidden='true'></i> "+v+"<br/>");
					        });
					    });
					  $("#panel_user_connected").show();
				  
			    // successful request; do something with the data
			    //$('#ajax-panel').empty();
			    //$(data).find('item').each(function(i){
			    //  $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
			    //});
			  },
			  error:function(){
				  $("#messaggio_creaStanza").html("<p>"+data+"</p>");
			    // failed request; give feedback to user
			    //$('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
				
			  }
			});
	}
	
	function abortTimer() { // to be called when you want to stop the timer
		  clearInterval(tid);
	}
		
	$("#panel_user_connected").hide();
	
	$("#accediStanzaForm").submit(function(e){
		$.ajax({
			  type: 'POST',
			  dataType: "json",
			  url: 'core/accediStanza.php',
			  data: { idStanza: $("#idStanza").val(), idAdmin: $("#idUtente").val() },
			  beforeSend:function(){
			    // this is where we append a loading image
			    //$('#ajax-panel-creaStanza').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				 
					  $("#accediStanzaModal").modal('toggle');
					  $("#creaStanza").hide();
					  $("#accediStanza").hide();
					  $(".sidebar-header").append("<h5>Connessi alla stanza:"+ data["nome_stanza"] +"</h5>");
					  
					  $.each(data["utenti_connessi"], function() {
					        $.each(this, function(k,v) {
					            //alert(k + ' ' + v);
					            $("#panel_user_connected_body").append("<i class='fa fa-user' aria-hidden='true'></i> "+v+"<br/>");
					        });
					    });
					  $("#panel_user_connected").show();
				  
			    // successful request; do something with the data
			    //$('#ajax-panel').empty();
			    //$(data).find('item').each(function(i){
			    //  $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
			    //});
			  },
			  error:function(){
				  $("#messaggio_creaStanza").html("<p>"+data+"</p>");
			    // failed request; give feedback to user
			    //$('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
				
			  }
			});
		 e.preventDefault();
	});
	
	$("#creaStanzaForm").submit(function(e){
		
		$.ajax({
			  type: 'POST',
			  url: 'core/creaStanza.php',
			  data: { nomeStanza: $("#nomeStanza").val(), idAdmin: $("#idUtente").val() },
			  beforeSend:function(){
			    // this is where we append a loading image
			    //$('#ajax-panel-creaStanza').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  if(data=='1'){
					  $("#creaStanzaModal").modal('toggle');
					  $("#creaStanza").hide();
					  $("#accediStanza").hide();
					  $(".sidebar-header").append("<h5>Connessi alla stanza:"+ $("#nomeStanza").val() +"</h5>");
					  
				  }
			    // successful request; do something with the data
			    //$('#ajax-panel').empty();
			    //$(data).find('item').each(function(i){
			    //  $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
			    //});
			  },
			  error:function(){
				  $("#messaggio_creaStanza").html("<p>"+data+"</p>");
			    // failed request; give feedback to user
			    //$('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
				
			  }
			});
		 e.preventDefault();
	});
	 
});