// Collapsible script
const collapseBtn = document.querySelectorAll(".navbar-toggler");
const collapseNav = document.querySelector(".navbar-collapse");

for (let i = 0; i < collapseBtn.length; i++) {
    collapseBtn[i].addEventListener("click", function () {
        collapseNav.classList.toggle("active")
    })
}

// Username and password input validation
function verifySignupForm() {
    let username = document.querySelector('#username').value;
    let psw = document.querySelector('#password').value;
    let uregex = new RegExp("^[a-zA-Z0-9]{8,15}$")

    // Username length
    if (!uregex.test(username)) {
        document.querySelector('#check_username').innerHTML = 'Username length between 8 to 15 required and only numbers/digits allowed';
        document.querySelector('#check_username').classList.remove('inactive');
        return false;
    } else {
        document.querySelector('#check_username').classList.add('inactive');
    }

    // Psw length
    if (psw.length < 8 || psw.length > 20) {
        document.querySelector('#check_psw').innerHTML = 'Password between 8 to 20 characters required';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
    }

    // Psw lowercase
    let lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    let found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (lowerCase.includes(temp)) {
            found = true;
            document.querySelector('#check_psw').classList.add('inactive');
            break;
        }
    }

    if (!found) {
        document.querySelector('#check_psw').innerHTML = 'Password needs at least 1 lowercase';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
    }

    // Psw uppercase
    let upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (upperCase.includes(temp)) {
            found = true;
            document.querySelector('#check_psw').classList.add('inactive');
            break;
        }
    }

    if (!found) {
        document.querySelector('#check_psw').innerHTML = 'Password needs at least 1 uppercase';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
    }

    // Psw digit
    let digit = '0123456789';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (digit.includes(temp)) {
            found = true;
            document.querySelector('#check_psw').classList.add('inactive');
            break;
        }
    }

    if (!found) {
        document.querySelector('#check_psw').innerHTML = 'Password needs at least 1 digit';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
    }

    // Psw special characters
    let specialChar = '!@#$%^&*';
    found = false;
    for (let i = 0; i < psw.length; i++) {
        let temp = psw.charAt(i);
        if (specialChar.includes(temp)) {
            found = true;
            document.querySelector('#check_psw').classList.add('inactive');
            break;
        }
    }

    if (!found) {
        document.querySelector('#check_psw').innerHTML = 'Password needs at least 1 special character';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
    }

    if (psw.includes(' ')) {
        document.querySelector('#check_psw').innerHTML = 'Password cannot contain space';
        document.querySelector('#check_psw').classList.remove('inactive');
        return false;
      }

      else {
        return true;
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
    //document.getElementById("cart_items").innerHTML = "";
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
    var addurl = "verify_order.php?pid="; //put this at the end of url later
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                addurl += a + ",";
            }
        }
    addurl = addurl.replace(/,+$/, ""); //remove the last comma
    addurl += "&verify_order="
    localStorage.clear();
    window.location.replace(addurl);
}
function view_ship_order(oid, pid_list){
    var addurl = "shipper_order.php?oid=" + oid + "&pids=" + pid_list + "&ship_ord=";
    window.location.replace(addurl);
}
function view_product(pid){
    var addurl = "view_pdetails.php?pid=" + pid +"&view_prod=";
    window.location.replace(addurl);
}