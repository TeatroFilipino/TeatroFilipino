const currentDate = new Date();
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth();

var selectedDay = 0;
var slots = 0;

function setupDateClickEventListeners() {
    const dates = document.querySelectorAll('.date');
    const hiddenInput = document.getElementById('selectedValue');

    dates.forEach(date => {
        let hasDate = date.innerHTML.trim();
        if(hasDate.length > 0 && hasDate >= currentDate.getDate()) {
            date.classList.add('future-date');
            date.addEventListener('click', function() {
                dates.forEach(otherBox => {
                    otherBox.classList.remove('selected');
                });
                this.classList.add('selected');

                selectedDay = this.textContent;
                hiddenInput.value = "" + currentYear + "-" + (Number(currentMonth)+1) + "-" + this.textContent;
                displaySelectedDate(selectedDay);

                updateSlotValue(selectedDay);

            });

        }else{
            date.style.opacity = "40%";
        }
    });
}


window.onload = populateCalendar;

function displaySelectedDate(selectedDay) {
    let showSelectedDate = document.getElementById('dateValue');
    showSelectedDate.innerHTML = "" + monthNames[currentMonth] + " " + selectedDay + ", " + currentYear;
}

function updateSlotValue(selectedDay) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_slot.php?date=' + selectedDay, true);

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            document.getElementById('slotValue').innerText = response.slots;
        }
    };
    xhr.send();
}

