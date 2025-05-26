document.addEventListener('DOMContentLoaded', function() {

})

function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var showPasswordCheckbox = document.getElementById("cbShow");

    if (showPasswordCheckbox.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}