$( document ).ready(function() {
     
	 $("#login_form").validate({
		    rules: {
		      email: {
		        required: true,
		        email: true
		      },
		      password: {
		        required: true,
		        minlength: 5
		      }
		    },
		    messages: {
		      password: {
		        required: "Inserisci una password",
		        minlength: "La password deve contenere almeno 5 caratteri"
		      },
		      email: "Inserisci una email valida"
		    },
		    submitHandler: function(form) {
		    	//niente
		    	form.submit();
		    }
		  });
	 
});