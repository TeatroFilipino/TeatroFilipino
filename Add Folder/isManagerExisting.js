// Purpose: To execute actions depending on whether the manager is existing or not

// accessing html elements from add_property_form.php through their ids
const select_manager_div = document.getElementById("select_manager");
const add_new_manager_div = document.getElementById("add_new_manager");
existing_mgr_id = document.getElementById("existing_mgr_id");
new_owner_id = document.getElementById("new_owner_id");
new_manager_id = document.getElementById("new_manager_id");
mgr_name = document.getElementById("mgr_name");
mgr_address = document.getElementById("mgr_address");
mgr_general_num =  document.getElementById("mgr_general_num");
mgr_emergency_num =  document.getElementById("mgr_emergency_num");
mgr_email =  document.getElementById("mgr_email");


function existing(){
    // display the div with id "select_manager" and hide the div with id "add_new_manager"
    select_manager_div.style.display = 'flex';
    add_new_manager_div.style.display = 'none';

    // remove the "required" attribute from the input fields that are not required if the manager is existing
    new_manager_id.removeAttribute("required");
    mgr_name.removeAttribute("required");
    mgr_address.removeAttribute("required");
    mgr_general_num.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the manager is new
    existing_mgr_id.setAttribute("required","");

    // if previously inputted, set the fields to empty to not retain values 
    new_manager_id.value = "";
    mgr_name.value = "";
    mgr_address.value = "";
    mgr_general_num.value = "";
    mgr_emergency_num.value = "";
    mgr_email.value = "";
}

function new_record(){
    // display the div with id "add_new_manager" and hide the div with id "select_manager"
    select_manager.style.display = 'none';
    add_new_manager.style.display = 'flex';

    // remove the "required" attribute from the input fields that are not required if the manager is new
    existing_mgr_id.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the manager is new
    new_manager_id.setAttribute("required","");
    mgr_name.setAttribute("required","");
    mgr_address.setAttribute("required","");
    mgr_general_num.setAttribute("required","");

    // if previously inputted, set the unrequired fields to empty to not retain values
    existing_mgr_id.value = "";


    // for id auto-incrementation
    // if the owner is using the new_id, set the manager id as the new_id plus 1
    if (new_owner_id.value == new_id){
        new_manager_id.value = new_id+1;
    }
    // if the manager is new and the owner is existing, set the manager id as the new_id
    else{
        new_manager_id.value = new_id;
    }
}

// when radio button for existing manager is clicked, execute function existing()
document.getElementById('existing_manager').addEventListener("click",existing);

// when radio button for new manager is clicked, execute function new_record()
document.getElementById('new_manager').addEventListener("click",new_record);