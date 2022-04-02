$('.deleteCourseButton').click(function() {

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

$('#courseModal').on('submit', function (e) {

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
                  //runs if a new user has been created
                  if (data[5] === true){
                    Swal.fire("Success", "User has been created.", "success");
                    //assigns users table to variable table
                    //reloads for now to show new user in table.
                    location.reload();
                  }
                  //runs if an existing user has been modified/updated
                  else if (data[5] === false){
                    Swal.fire("Success", "User has been updated.", "success");
                    //getting ID of table row element that is related to this specific user
                    var rowName = "row" + data[0];
                    //updating form email field with ajax
                    var parentRow = document.getElementById(rowName);
                    //updating email table field with returned new email
                    parentRow.children[1].textContent = data[1];
                    //updating first name table field with returned new first name
                    parentRow.children[2].textContent = data[2];
                    //updating last name table field with returned new last name
                    parentRow.children[3].textContent = data[3];
                    //updating access level table field with returned new access level
                    parentRow.children[4].textContent = data[4];
                    //updating job title table field with returned new job title
                    parentRow.children[5].textContent = data[6];
                  }

                },
                error: function() {
                    Swal.fire("Error", "There was an error updating the user.", "error");
                }
            });
      }
  })  
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


