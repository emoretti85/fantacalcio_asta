$( document ).ready(function() {
   
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