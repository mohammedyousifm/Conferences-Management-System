
/* ---------------------------------------------
    Js Function
    1- Ajax - Function update the status
    2- JavaScript to Show/Hide Checkboxes  (Per Paper ID)
    3-
    4-
    5-
---------------------------------------------  */

/*
 - (1) Ajax - Function
 - Ajax fuction to update the status of the Paper
 - The function is implemnt in File './2-Dashboard/controller/allpapers'
*/
function handleStatusChange(paperId) {
    let selectElement = document.getElementById('status-select-' + paperId);
    let submitButton = document.getElementById('submit-btn-' + paperId);

    // Show the submit button only if the selected value is different from the initial value
    if (selectElement.value !== selectElement.options[0].value) {
        submitButton.style.display = 'inline-block';
    } else {
        submitButton.style.display = 'none';
    }
}

/*
 - (2)  JavaScript to Show/Hide Checkboxes  (Per Paper ID)
 - Ajax fuction to update the status of the Paper
 - The function is implemnt in File './2-Dashboard/controller/allpapers'
*/
   function toggleUserList(paperId) {
       var form = document.getElementById("user-form-" + paperId);
       form.classList.toggle("d-none");
   }

   function toggleUserList(paperId) {
       let form = document.getElementById(`user-form-${paperId}`);
       form.classList.toggle('d-none');
   }

   function limitSelection(paperId) {
       let checkboxes = document.querySelectorAll(`.user-checkbox-${paperId}:not(:disabled)`);
       let selectedUsersDiv = document.getElementById(`selected-users-${paperId}`);
       let selectedUsers = [];

       checkboxes.forEach((checkbox) => {
           if (checkbox.checked) {
               selectedUsers.push({
                   id: checkbox.value,
                   name: checkbox.nextElementSibling.innerText
               });
           }
       });

       // Prevent selection of more than 3 users
       if (selectedUsers.length > 3) {
           alert("You can only select up to 3 users.");
           event.target.checked = false;
           return;
       }

       // Display selected users
       selectedUsersDiv.innerHTML = selectedUsers.map(user => `
           <span class="badge bg-success p-2 me-1">${user.name}
               <button type="button" class="btn-close btn-close-white ms-1" onclick="removeUser(${user.id}, ${paperId})"></button>
           </span>
       `).join('');
   }

   function removeUser(userId, paperId) {
       let checkboxes = document.querySelectorAll(`.user-checkbox-${paperId}`);

       checkboxes.forEach((checkbox) => {
           if (checkbox.value == userId) {
               checkbox.checked = false;
           }
       });

       limitSelection(paperId);
   }

  /*
 - (3)  JavaScript function to Show/Hide Conferences filter The Conferences
 -                  (Per Conferences Statues)
 - The function is implemnt in File './2-Dashboard/controller/Conferences'
*/
function filterconferences(status) {
    let rows = document.querySelectorAll(".conferences-row");
    let matchFound = false;

    rows.forEach(row => {
        if (status === "all" || row.getAttribute("data-status") === status) {
            row.style.display = "table-row";
            setTimeout(() => row.classList.remove("hidden"), 50);
            matchFound = true;
        } else {
            row.classList.add("hidden");
            setTimeout(() => row.style.display = "none", 500); // Hides row after animation
        }
    });

    // Show "No match found" if no rows are visible
    let noMatchDiv = document.getElementById("no-match");
    if (!matchFound) {
        noMatchDiv.style.display = "block";
        setTimeout(() => noMatchDiv.style.opacity = "1", 50);
    } else {
        noMatchDiv.style.opacity = "0";
        setTimeout(() => noMatchDiv.style.display = "none", 500);
    }
}


  /*
 - (4)  JavaScript function to Show/Hide paper filter The paper
 -                  (Per paper Statues)
 - The function is implemnt in File './2-Dashboard/controller/paper'
*/
function filterPapers(status) {
    let rows = document.querySelectorAll(".paper-row");
    let matchFound = false;

    rows.forEach(row => {
        if (status === "all" || row.getAttribute("data-status") === status) {
            row.style.display = "table-row";
            setTimeout(() => row.classList.remove("hidden"), 50);
            matchFound = true;
        } else {
            row.classList.add("hidden");
            setTimeout(() => row.style.display = "none", 500); // Hides row after animation
        }
    });

    // Show "No match found" if no rows are visible
    let noMatchDiv = document.getElementById("no-match");
    if (!matchFound) {
        noMatchDiv.style.display = "block";
        setTimeout(() => noMatchDiv.style.opacity = "1", 50);
    } else {
        noMatchDiv.style.opacity = "0";
        setTimeout(() => noMatchDiv.style.display = "none", 500);
    }
}
