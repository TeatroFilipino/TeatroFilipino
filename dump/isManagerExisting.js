const select_manager = document.getElementById("select_manager");
const add_new_manager = document.getElementById("add_new_manager");

function isManagerExisting(){
  if (document.getElementById('existing_manager').checked) {
    select_manager.style.display = 'block';
    add_new_manager.style.display = 'none';
  } 
  else {
    select_manager.style.display = 'none';
    add_new_manager.style.display = 'block';
  }
}

const radioButtonsManager = document.querySelectorAll('input[name="if_existing_mgr"]');
radioButtonsManager.forEach(radio => {
  radio.addEventListener('click', isManagerExisting);
});