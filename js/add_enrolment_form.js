var $enrolledCarousel = $('.enrolled-carousel').flickity();
var $unEnrolledCarousel = $('.unenrolled-carousel').flickity();

$('.enrolled-carousel').flickity({
  // options
  cellAlign: 'left',
  contain: true
});

$('.unenrolled-carousel').flickity({
  // options
  cellAlign: 'left',
  contain: true
});

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
                        //destroy current flickity carousel, change elements of cards, then rebuild flickity afterwards with new values
                        $enrolledCarousel.flickity('destroy');
                        $('#enrolled').html(newState);
                        $enrolledCarousel.flickity();

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

                      //destroy current flickity carousel, change elements of cards, then rebuild flickity afterwards with new values
                      $unEnrolledCarousel.flickity('destroy');
                      $('#non-enrolled').html(newState);
                      $unEnrolledCarousel.flickity();

                      $('#Modal').modal('hide');
                      Swal.fire("Success", "Enrolment has been Cancelled.", "success");
                    },
                    error: function() {
                        Swal.fire("Error", "There was an error Updating the Courses Table", "error");
                    }
                });
                reloadFlickity();
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
                //Ajax to update the enrolled courses cards
                $.ajax({
                  type: "post",
                  url: "../php/retrieve_enrolments.php",
                  dataType: 'html',
    
                    success: function(data2) {
                      var newState = $.trim(data2);

                      //destroy current flickity carousel, change elements of cards, then rebuild flickity afterwards with new values
                      $enrolledCarousel.flickity('destroy');
                      $('#enrolled').html(newState);
                      $enrolledCarousel.flickity();

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
                      
                      //destroy current flickity carousel, change elements of cards, then rebuild flickity afterwards with new values
                      $unEnrolledCarousel.flickity('destroy');
                      $('#non-enrolled').html(newState);
                      $unEnrolledCarousel.flickity();

                      $('#Modal').modal('hide');
                    },
                    error: function() {
                        Swal.fire("Error", "There was an error Updating the Courses Table", "error");
                    }
            });
                if(data == "success"){
                  Swal.fire("Success", "You've been Enrolled Successfully", "success");
                }
                else if (data == "error with mail"){
                  Swal.fire("Error", "Error with confirmation email, You're now Enrolled", "error");
                }
                else if (data == "course at capacity"){
                  Swal.fire("Error", "Course is at Capacity", "error");
                }
                else{
                  Swal.fire("Error", "An unknown error has occurred, you have been enrolled", "error")
                }
              },
              error: function(data) {
                  Swal.fire("Error", "There was an error", "error");
              }
          });
    }
  })  
});



