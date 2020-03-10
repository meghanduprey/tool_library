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
      hashed_password: {
        required: true,
        rangelength: [8,16]
      },
      confirm_password: {
        equalTo: "#hashed_password"
      }
    }, //end rules
    messages: {
      hashed_password: {
        required: "Please type the password you'd like to use.",
        rangelength: "Your password must be between 8 and 16 characters long."
      },
      confirm_password: {
        equalTo: "The two passwords do not match"
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
  
  var url = window.location.href;
  var activePage = url;
  $('.header-right a').each(function () {
      var linkPage = this.href;

      if (activePage == linkPage) {
          $(this).addClass("active");
      }
    });
}); // end document ready

  //NEW RATING FORM

window.onload = init;

function init () {
  hiddenmember();
}

function hiddenmember() {

  document.querySelector('input[list]').addEventListener('input', function(e) {
    var input = e.target,
    list = input.getAttribute('list'),
    options = document.querySelectorAll('#' + list + ' option'),
    hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
    label = input.value;

    hiddenInput.value = label;

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === label) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }
    }
  });
}
