function validLoginForm(form){
    if((form.username.value != "") && (form.password.value != "")){
        return true;
    }
    alert("Please Fill All the Field First!");
    return false;
}
function validSignupForm(form){
    if((form.fullname.value != "") && (form.username.value != "") && (form.password.value != "") (form.email.value != "") && (form.address.value != "") && (form.nid.value != "") && (form.gender.value != "") && (form.phone.value != "") && (form.dob.value != "") && (form.profilepic.value != "") && (form.accesskey.value != "")){
        return true;
    }
    alert("Please Fill All the Field First!");
    return false;
}
function validOtpVerifyForm(form){
    if((form.otp.value != "")){
        return true;
    }
    alert("Please Enter OTP!");
    return false;
}
function validAdminTaskForm(form){
    if((form.task.value != "")){
        return true;
    }
    alert("Task cannot be Empty!");
    return false;
}
function validForgotPasswordForm(form){
    if((form.email.value != "")){
        return true;
    }
    alert("Email cannot be Empty!");
    return false;
}