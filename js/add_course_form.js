$(document).on("click", ".deleteCourseButton", function(){
  Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Delete',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {

          var thisObject = this
          var id = this.id;

          $.ajax({
              type: "POST",
              url: "../../php/delete_course.php",
              data: {
                  CID: id
              },
              success: function() {
                  $(thisObject).parent().parent().remove();
                  Swal.fire("Success", "User has been deleted.", "success");

              },
              error: function() {
                  Swal.fire("Error", "There was an error deleting the user.", "error");
              }
          });
    }
  })  
});

$(document).on("submit", "#courseModal", function(e){

  e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Submit',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            var thisObject = this;
            var form = $(this);
            var id = this.id;
            var Modal = document.getElementById('Modal');
            var modalTitle = Modal.querySelector('.modal-title').textContent;
            var form = $( "#courseModal" ).serialize();

            $.ajax({
                type: "POST",
                url: "../../php/change_courses.php",
                data: $( "#courseModal" ).serialize() + "&title="+ modalTitle,
                dataType: "json",
                success: function(data) {
                  $.ajax({
                    type: "post",
                    url: "../../php/retrieve_courses.php",
                    dataType: 'html',
      
                    success: function(data2) {
                      var newState = $.trim(data2);
                      $('.tableWrap').html(newState);
                      $('#Modal').modal('hide');
                      if (data[5] === true){
                        Swal.fire("Success", "Course has been created.", "success");
                      }
                      //runs if an existing user has been modified/updated
                      else if(data[5] === false){
                        Swal.fire("Success", "Course has been updated.", "success");
                      }
                    },
                    error: function() {
                        Swal.fire("Error", "There was an error Updating the Courses Table", "error");
                    }
                });
                },
                error: function() {
                    Swal.fire("Error", "There was an error updating the Course.", "error");
                }
            });
      }
  })  
});

$(document).on("click", ".viewUsersButton", function(){
  var thisObject = this
  var id = this.id;

  $.ajax({
              type: "post",
              url: "../../php/retrieve_users_on_course.php",
              dataType: 'html',
              data: {
                  courseID: id
              },

              success: function(data) {
                var newState = $.trim(data);
                $('#participantsTableWrap').html(newState);
              },
              error: function() {
                  Swal.fire("Error", "There was an error Cancelling the Enrolment", "error");
              }
          });

});

var Modal = document.getElementById('Modal')
Modal.addEventListener('show.bs.modal', function (event) {
  // Assign button that triggered model to variable to access its attributes
  var button = event.relatedTarget;
  // Retrieve information from button that triggered modal
  var courseName = button.getAttribute('data-bs-coursename');
  var courseDate = button.getAttribute('data-bs-coursedate');
  var courseDuration = button.getAttribute('data-bs-courseduration');
  var maxAttendees = button.getAttribute('data-bs-maxattendees');
  var courseDescription = button.getAttribute('data-bs-coursedescription');
  var targetid = button.getAttribute('id');
  //Assign modal fields to variable for assignment later
  var modalTitle = Modal.querySelector('.modal-title');
  var modalName = Modal.querySelector('.courseName');
  var modalDate = Modal.querySelector('.courseDate');
  var modalDuration = Modal.querySelector('.courseDuration');
  var modalAttendees = Modal.querySelector('.maxAttendees');
  var modalCourseDescription = Modal.querySelector('.courseDescription');
  var modalTargetID = Modal.querySelector('.targetid');
  //update title of Modal with name of user
  if (courseName == null){
    modalTitle.textContent = 'New Course';
  }else{
    modalTitle.textContent = 'Updating course: ' + courseName;
  }

  //Change values of modal with data pulled from the button
  modalName.value = courseName;
  modalDate.value = courseDate;
  modalDuration.value = courseDuration;
  modalAttendees.value = maxAttendees;
  modalCourseDescription.value = courseDescription;
  modalTargetID.value = targetid
})


