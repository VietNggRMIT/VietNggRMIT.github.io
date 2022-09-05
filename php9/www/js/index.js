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
    let pws = document.querySelector('#password').value;

    // Length
    if (pws.length < 8 || pws.length > 20) {
        return false;
    }

    // Lowercase
    let lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    let found = false;
    for (let i = 0; i < pws.length; i++) {
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
    for (let i = 0; i < pws.length; i++) {
        let temp = pws.charAt(i);
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
    for (let i = 0; i < pws.length; i++) {
        let temp = pws.charAt(i);
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
    for (let i = 0; i < pws.length; i++) {
        let temp = pws.charAt(i);
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

function clearcart(){
    localStorage.clear();
    document.getElementById("cart_items").innerHTML = "";
}
function viewcart(){
    var addurl = "view_cart.php?pid="; //put this at the end of url later
    for(var a in localStorage){
        if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
            addurl += a + ",";
        }
    }
    addurl = addurl.replace(/,+$/, ""); //remove the last comma
    addurl += "&view_cart="
    window.location.replace(addurl);
}
function removeitem(pid){ //remove an item from localstorage. refresh page and show items.
    localStorage.removeItem(pid);
    var addurl = "view_cart.php?pid="; //put this at the end of url later
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                addurl += a + ",";
            }
        }
    addurl = addurl.replace(/,+$/, ""); //remove the last comma
    addurl += "&view_cart="
    window.location.replace(addurl);
}
function placeorder(){ //send GET data to another page, which would show order details
    var addurl = "view_order.php?pid="; //put this at the end of url later
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                addurl += a + ",";
            }
        }
    addurl = addurl.replace(/,+$/, ""); //remove the last comma
    addurl += "&view_order="
    localStorage.clear();
    window.location.replace(addurl);
}