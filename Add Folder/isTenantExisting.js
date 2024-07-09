// Purpose: To execute actions depending on whether the owner is existing or not

// accessing html elements from add_property_form.php through their ids
const select_tenant_div = document.getElementById("select_tenant");
const add_new_tenant_div = document.getElementById("add_new_tenant");
existing_tenant_id = document.getElementById("existing_tenant_id");
new_tenant_id = document.getElementById("new_tenant_id");
tenant_name = document.getElementById("tenant_name");
tenant_address = document.getElementById("tenant_address");
tenant_general_num = document.getElementById("tenant_general_num");
tenant_emergency_num = document.getElementById("tenant_emergency_num");
tenant_email = document.getElementById("tenant_email");


function existing(){
    // display the div with id "select_tenant" and hide the div with id "add_new_tenant"
    select_tenant_div.style.display = 'flex';
    add_new_tenant_div.style.display = 'none';

    // remove the "required" attribute from the input fields that are not required if the owner is existing
    new_tenant_id.removeAttribute("required");
    tenant_name.removeAttribute("required");
    tenant_address.removeAttribute("required");
    tenant_general_num.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the tenant is new
    existing_tenant_id.setAttribute("required","");

    // if previously inputted, set the fields to empty to not retain values
    new_tenant_id.value = "";
    tenant_name.value = "";
    tenant_address.value = "";
    tenant_general_num.value = "";
    tenant_emergency_num.value = "";
    tenant_email.value = "";

}

function new_record(){
    // display the div with id "add_new_tenant" and hide the div with id "select_tenant"
    select_tenant_div.style.display = 'none';
    add_new_tenant_div.style.display = 'flex';

    // remove the "required" attribute from the input fields that are not required if the tenant is new
    existing_tenant_id.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the tenant is new
    new_tenant_id.setAttribute("required","");
    tenant_name.setAttribute("required","");
    tenant_address.setAttribute("required","");
    tenant_general_num.setAttribute("required","");

    // if previously inputted, set the fields to empty to not retain values
    existing_tenant_id.value = "";

    // for id auto-incrementation
    // if the tenant is new, set the owner id as the new_id
    new_tenant_id.value = new_id;
}

// when the radio button for existing owner is clicked, execute the function existing()
document.getElementById('existing_tenant').addEventListener("click",existing);

// when the radio button for new owner is clicked, execute the function new_record()
document.getElementById('new_tenant').addEventListener("click",new_record);