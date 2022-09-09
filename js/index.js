// Collapsible script
const collapseBtn = document.querySelectorAll(".navbar-toggler");
const collapseNav = document.querySelector(".navbar-collapse");

for (let i = 0; i < collapseBtn.length; i++) {
    collapseBtn[i].addEventListener("click", function () {
        collapseNav.classList.toggle("active")
    })
}




// Username input validation

// Password input validation
function verifyPassword() {
    let psw = document.querySelector('#password').value;

    // Length
    if (psw.length < 8 || psw.length > 20) {
        return false;
    }

    // Lowercase
    let lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    let found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = pass.charAt(i);
        if (lowerCase.includes(temp)) {
            found = true;
            console.log(found);
            break;
        }
    }

    if (!found) {
        return false;
    }

    // Uppercase
    let upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (upperCase.includes(temp)) {
            found = true;
            break;
        }
    }

    if (!found) {
        return false;
    }

    // Digit
    let digit = '0123456789';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (digit.includes(temp)) {
            found = true;
            break;
        }
    }

    if (!found) {
        return false;
    }

    // Special characters
    let specialChar = '!@#$%^&*';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (specialChar.includes(temp)) {
            found = true;
            break;
        }
    }

    if (!found) {
        return false;
    }
}

// Number input validation
function isNum(event) {
    event = (event) ? event: window.event;
    let charCode = (event.which) ? event.which : event.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        event.preventDefault();
    } else {
        return true;
    }
}