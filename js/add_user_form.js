document.getElementById("1").disabled = true;
document.getElementById("1").style.backgroundColor = "DarkGrey";
document.getElementById("1").style.borderColor = "DarkGrey";

$('.deleteUserButton').click(function() {

  Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Delete'
  }).then((result) => {
      if (result.isConfirmed) {

          var thisObject = this
          var id = this.id;

          $.ajax({
              type: "POST",
              url: "../../php/delete_user.php",
              data: {
                  UID: id
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

$('#userModal').on('submit', function (e) {

  e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Submit'
    }).then((result) => {
        if (result.isConfirmed) {

            var thisObject = this;
            var form = $(this);
            var id = this.id;
            var Modal = document.getElementById('Modal');
            var modalTitle = Modal.querySelector('.modal-title').textContent;
            var form = $( "#userModal" ).serialize();

            $.ajax({
                type: "POST",
                url: "../../php/change_users.php",
                data: $( "#userModal" ).serialize() + "&title="+ modalTitle,
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
  var button = event.relatedTarget
  // Retrieve information from button that triggered modal
  var firstName = button.getAttribute('data-bs-firstName');
  var lastName = button.getAttribute('data-bs-lastName');
  var email = button.getAttribute('data-bs-email');
  var targetid = button.getAttribute('id');
  //Assign modal fields to variable for assignment later
  var modalTitle = Modal.querySelector('.modal-title')
  var modalFirstName = Modal.querySelector('.fName')
  var modalLastName = Modal.querySelector('.lName')
  var modalEmail = Modal.querySelector('.email')
  var modalTargetID = Modal.querySelector('.targetid')
  //update title of Modal with name of user
  if (firstName == null){
    modalTitle.textContent = 'New User'
  }else{
    modalTitle.textContent = 'Updating user: ' + firstName
  }

  //Change values of modal with data pulled from the button
  modalFirstName.value = firstName
  modalLastName.value = lastName
  modalEmail.value = email
  modalTargetID.value = targetid
})


