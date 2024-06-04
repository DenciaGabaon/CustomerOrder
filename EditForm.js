var EditForm;
document.addEventListener("DOMContentLoaded", function() {
    console.log("EditForm.js is loaded");
    let Editbutton = document.getElementById("Edit");

    Editbutton.addEventListener("click", function() {
        let EditForm = document.createElement("div");
        EditForm.className = "EditForm";
        console.log("Edit button is clicked");
        document.body.appendChild(EditForm);

        let EditFormField = document.createElement("div");
        EditFormField.className = "EditFormField";
        EditForm.appendChild(EditFormField);

        let id = document.createElement("input");
        id.type = "text";
        id.placeholder = "ID";
        id.value = customerInfo.CustomerID;
        id.disabled = true;
        id.id = "id";
        EditFormField.appendChild(id);

        let firstname = document.createElement("input");
        firstname.type = "text";
        firstname.placeholder = "First Name";
        firstname.id = "firstname";
        EditFormField.appendChild(firstname);

        let lastname = document.createElement("input");
        lastname.type = "text";
        lastname.placeholder = "Last Name";
        lastname.id = "lastname";
        EditFormField.appendChild(lastname);

        let email = document.createElement("input");
        email.type = "email";
        email.placeholder = "Email";
        email.id = "email";
        EditFormField.appendChild(email);

        let buttonField = document.createElement("div");
        buttonField.className = "buttonField";
        EditForm.appendChild(buttonField);

        let submit = document.createElement("button");
        submit.type = "submit";
        submit.textContent = "Submit";
        submit.id = "submit";
        buttonField.appendChild(submit);

        let cancel = document.createElement("button");
        cancel.type = "button";
        cancel.textContent = "Cancel";
        cancel.id = "cancel";
        buttonField.appendChild(cancel);

        cancel.addEventListener("click", function() {
            EditForm.remove();
        });

        

        submit.addEventListener("click", function() {
            let customerId = document.getElementById('id').value;
            let firstname = document.getElementById('firstname').value;
            let lastname = document.getElementById('lastname').value;
            let email = document.getElementById('email').value;

            console.log(customerId);
            console.log(firstname);
            console.log(lastname);
            console.log(email);

            // Add more fields as necessary

            fetch('EditCustomer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    customerId: customerId,
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    // Add more fields as necessary
                }),
            })
            .then(response => response.json())
            .then(data => {
                showNotification('Customer updated successfully');
                //alert('Customer updated successfully');
                console.log('Success:', data);
            })
            .catch((error) => {
                showNotification('Error: ' + error);
                //alert('Error:', error);
                console.error('Error:', error);
            });
        });
        window.EditForm = EditForm;
    });

    //document.body.appendChild(EditForm);
});
