const select_owner = document.getElementById("select_owner");
const add_new_owner = document.getElementById("add_new_owner");

function isOwnerExisting(){
  if (document.getElementById('existing_owner').checked) {
    select_owner.style.display = 'block';
    add_new_owner.style.display = 'none';
  } 
  else {
    select_owner.style.display = 'none';
    add_new_owner.style.display = 'block';
  }
}

const radioButtonsOwner = document.querySelectorAll('input[name="if_existing_ownr"]');
radioButtonsOwner.forEach(radio => {
  radio.addEventListener('click', isOwnerExisting);
});
