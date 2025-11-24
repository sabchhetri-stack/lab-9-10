document.addEventListener("DOMContentLoaded", function() {
    const pw = document.getElementById("password");
    const cpw = document.getElementById("confirmPassword");
    const message = document.getElementById("pwMessage");

    function check() {
        if (pw.value === cpw.value) {
            message.textContent = "Passwords match";
            message.style.color = "green";
        } else {
            message.textContent = "Passwords do not match";
            message.style.color = "red";
        }
    }

    pw.addEventListener("input", check);
    cpw.addEventListener("input", check);
});
