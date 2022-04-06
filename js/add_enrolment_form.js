$(document).on("click", ".cancelEnrolmentButton", function(){

  Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Cancel',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {

          var thisObject = this
          var id = this.id;

          $.ajax({
              type: "POST",
              url: "../php/delete_enrolment.php",
              data: {
                  enrolmentID: id
              },
              success: function() {
                //Ajax to update the enrolled courses cards
                    $.ajax({
                      type: "post",
                      url: "../php/retrieve_enrolments.php",
                      dataType: 'html',
        
                      success: function(data2) {
                        var newState = $.trim(data2);
                        $('#enrolled').html(newState);
                        $('#Modal').modal('hide');
                      },
                      error: function() {
                          Swal.fire("Error", "There was an error Updating the Enrolments Table", "error");
                      }
                  });
                  //Ajax to update the non-enrolled courses cards
                  $.ajax({
                    type: "post",
                    url: "../php/retrieve_non_enrolled.php",
                    dataType: 'html',
      
                    success: function(data2) {
                      var newState = $.trim(data2);
                      $('#non-enrolled').html(newState);
                      $('#Modal').modal('hide');
                      Swal.fire("Success", "Enrolment has been Cancelled.", "success");
                    },
                    error: function() {
                        Swal.fire("Error", "There was an error Updating the Courses Table", "error");
                    }
                });
              },
              error: function() {
                  Swal.fire("Error", "There was an error Cancelling the Enrolment", "error");
              }
          });
    }
  })  
});


$(document).on("click", ".enrolButton", function(){

  Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to enrol on this course?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'green',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Submit',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {

          var thisObject = this
          var id = this.id;

          $.ajax({
              type: "POST",
              url: "../php/create_enrolment.php",
              data: {
                courseID : id
              },
              dataType: "text",
              success: function(data) {
                if(data=="success"){
                  Swal.fire("Success", "You've been Enrolled Successfully", "success");
                    //Ajax to update the enrolled courses cards
                    $.ajax({
                      type: "post",
                      url: "../php/retrieve_enrolments.php",
                      dataType: 'html',
        
                        success: function(data2) {
                          var newState = $.trim(data2);
                          $('#enrolled').html(newState);
                          $('#Modal').modal('hide');
                        },
                        error: function() {
                            Swal.fire("Error", "There was an error Updating the Enrolments Table", "error");
                        }
                  });
                  //Ajax to update the non-enrolled courses cards
                    $.ajax({
                      type: "post",
                      url: "../php/retrieve_non_enrolled.php",
                      dataType: 'html',
        
                        success: function(data2) {
                          var newState = $.trim(data2);
                          $('#non-enrolled').html(newState);
                          $('#Modal').modal('hide');
                          Swal.fire("Success", "Enrolment has been Created", "success");
                        },
                        error: function() {
                            Swal.fire("Error", "There was an error Updating the Courses Table", "error");
                        }
                });
              }
              else{
                Swal.fire("Error", "Course is at Capacity", "error");
              }
              },
              error: function(data) {
                  Swal.fire("Error", "There was an error", "error");
              }
          });
    }
  })  
});



