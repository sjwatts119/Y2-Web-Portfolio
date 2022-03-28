document.getElementById("1").disabled = true;
document.getElementById("1").style.backgroundColor = "DarkGrey";

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
            console.log(modalTitle);
            console.log($( "#userModal" ).serialize() + "&title="+ modalTitle + "&UID="+ id);

            $.ajax({
                type: "POST",
                url: "../../php/change_users.php",
                data: $( "#userModal" ).serialize() + "&title="+ modalTitle + "&UID="+ id,
                success: function() {
                    $(thisObject).parent().parent().remove();
                    Swal.fire("Success", "User has been updated.", "success");

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
  var targetid = button.getAttribute('data-bs-email');
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


