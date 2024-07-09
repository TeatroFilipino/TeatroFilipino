function addGuest() {
    if(canAddGuest()){
        var newForm = document.createElement("div");
            newForm.className = "form";
            // Copy the HTML structure of a single guest form
            newForm.innerHTML = document.querySelector(".form").innerHTML;

            // Add a remove button to the new form
            var removeButton = document.createElement("button");
            removeButton.className = "remove-btn";
            removeButton.textContent = "Remove";
            removeButton.onclick = function () {
                removeGuest(newForm);
            };

            newForm.querySelector(".remove-btn-container").appendChild(removeButton);

            // Append the new form to the container
            document.getElementById("guestFormsContainer").appendChild(newForm);
    }
}

function canAddGuest() {
    var allForms = document.querySelectorAll(".form");
    // Check if the maximum number of guests has been reached
    var canAdd = true;

    allForms.forEach(function (form) {
        var requiredInputs = form.querySelectorAll("[required]");
        requiredInputs.forEach(function (input) {
            if (!input.value.trim()) {
                canAdd = false;
            }
        });
    });

    if (canAdd) {
        var termsCheckboxes = document.querySelectorAll("[name='termsAndCondition']");
        termsCheckboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
                canAdd = false;
                alert("Please agree to the Terms and Conditions before adding a new guest.");
            }
        });
    } else {
        alert("Please fill out all fields in existing forms before adding a new guest.");
    }
    return canAdd;
}







