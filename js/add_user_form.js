function disableMainAdmin(){
  document.getElementById("1").disabled = true;
  document.getElementById("1").style.backgroundColor = "DarkGrey";
  document.getElementById("1").style.borderColor = "DarkGrey";
}

disableMainAdmin();

$(document).on("click", ".deleteUserButton", function(){

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

$(document).on("submit", "#userModal", function(e){

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
            var form = $( "#userModal" ).serialize();

            $.ajax({
                type: "POST",
                url: "../../php/change_users.php",
                data: $( "#userModal" ).serialize() + "&title="+ modalTitle,
                dataType: "json",
                success: function(data) {

                  //Ajax to update the table
                  $.ajax({
                    type: "post",
                    url: "../../php/retrieve_users.php",
                    dataType: 'html',
      
                    success: function(data2) {
                      var newState = $.trim(data2);
                      $('.tableWrap').html(newState);
                      $('#Modal').modal('hide');
                      if (data[5] === true){
                        Swal.fire("Success", "User has been created.", "success");
                      }
                      //runs if an existing user has been modified/updated
                      else if(data[5] === false){
                        Swal.fire("Success", "User has been updated.", "success");
                      }
                      disableMainAdmin();
                    },
                    error: function() {
                        Swal.fire("Error", "There was an error Updating the Users Table", "error");
                    }
                });
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
  var jobTitle = button.getAttribute('data-bs-jobtitle');
  var targetid = button.getAttribute('id');
  //Assign modal fields to variable for assignment later
  var modalTitle = Modal.querySelector('.modal-title')
  var modalFirstName = Modal.querySelector('.fName')
  var modalLastName = Modal.querySelector('.lName')
  var modalJobTitle = Modal.querySelector('.jobTitle')
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
  modalJobTitle.value = jobTitle
  modalEmail.value = email
  modalTargetID.value = targetid

})


