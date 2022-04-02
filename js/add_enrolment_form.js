$('.cancelEnrolmentButton').click(function() {

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
                  $(thisObject).parent().parent().remove();
                  Swal.fire("Success", "Enrolment has been Cancelled", "success");
                  location.reload();

              },
              error: function() {
                  Swal.fire("Error", "There was an error Cancelling the Enrolment", "error");
              }
          });
    }
  })  
});

$('.enrolButton').click(function() {

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
                    location.reload();
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



