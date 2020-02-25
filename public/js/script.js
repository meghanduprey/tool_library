$( document ).ready(function() { 
  $('#newMemberForm').validate({
    rules: {
      fname: 'required',
      lname: 'required',
      email: {
        required: true,
        email: true              
             },
      phone: 'required',
      password: {
        required: true,
        rangelength: [8,16]
      },
      confirm_password: {
        equalTo: '#password'
      }
    }, //end rules
    messages: {
      password: {
        required: "Please type the password you'd like to use.",
        rangelength: "Your password must be between 8 and 16 characters long."
      },
      confirm_password: {
        equalTo: "The two passwords don't match."
      }
    }, //end messages
    errorPlacement: function(error,element) {
      error.insertAfter(element);
    }//end error placement
  });//end validate
  
  $('#editMemberForm').validate({
    rules: {
      tool_name: 'required',
      tool_description: 'required',
      
    }, //end rules
    errorPlacement: function(error,element) {
      error.insertAfter(element);
    }//end error placement
  });//end validate
    
    $('#newTool').validate({
    rules: {
      tool_name: 'required',
      tool_description: 'required',
      category_ID: 'required',
      tool_picture: {
        required: true,
        extension: "png|jpg|jpeg"
        }
    }, //end rules
    errorPlacement: function(error,element) {
      if(element.is(":radio") || element.is(":checkbox")) {
        error.appendTo(element.parent());
      } else {
      error.insertAfter(element);
      }
      }//end error placement
  });//end validate
  
  $('#editTool').validate({
    rules: {
      tool_name: 'required',
      tool_description: 'required',
      category_ID: 'required'
    }, //end rules
    errorPlacement: function(error,element) {
      if(element.is(":radio") || element.is(":checkbox")) {
        error.appendTo(element.parent());
      } else {
      error.insertAfter(element);
    } 
    }//end error placement
  });//end validate
    
    $('#newRating').validate({
    rules: {
      name: 'required',
      rating: 'required'
    }, //end rules
    errorPlacement: function(error,element) {
      error.insertAfter(element);
    }//end error placement
  });//end validate
  

}); // end document ready

                    
