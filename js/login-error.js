function loginError(sErrorType){
    //close previous errors before opening a new one
    $("#errorPassword").hide();
    $("#errorEmail").hide();

    //if error is due to password, show incorrect password warning
    if(sErrorType == "error1"){
        $("#errorPassword").show();
    }
    //if error is due to incorrect email address, show email warning.
    else if (sErrorType == "error2"){
        $("#errorEmail").show();
    }
    //if error is due to recaptcha score being too low, show captcha warning
    else if (sErrorType == "error3"){
        $("#errorCaptcha").show();
    }
    else if (sErrorType == "error4"){
        $("#errorAttempts").show();
    }
    //for anything else, show an alert that an error has occurred (This shouldn't be able to run but is there for redundancy)
    else{
        alert("An error has occurred");
    }
}