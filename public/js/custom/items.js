const addItemFrm           = document.querySelector('#addIitemForm');
const editItemFrm          = document.querySelector('#editItemFrm');
const deleteItemFrm        = document.querySelector('#deleteItemFrm');
const errorElement         = document.querySelector('#error-message');
const editItemErrorElement = document.querySelector('#edit-item-error-message');

const _token               = document.getElementsByName('csrf-token')[0]
                               .getAttribute('content');




const addErrorMessage = (element  , errorElement , errorMessage) => {
        // Add red color for text
        element.classList.add('text-danger');

        // Add border
        element.classList.add('border');

        // Add red color for border
        element.classList.add('border-danger');

        // Add error message 
        errorElement.innerHTML = `${errorMessage}`;
};

const removeErrorMessage = (element , errorElement) => {

        // Add red color for text
        element.classList.remove('text-danger');

        // Add red color for border
        element.classList.remove('border-danger');

        // Remove error message 
        errorElement.innerHTML = ``;
};

const deleteItem = (item) => {
    // Display edit item modal
    $('#deleteItemModal').modal('toggle');

    // Set item id attribute this is the id of selected Item
    deleteItemFrm.setAttribute('item-id',item.id);
};

const deleteData = (url = `` , data = {}) => {
    return fetch(url, {
        method: "DELETE", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // "Content-Type": "application/x-www-form-urlencoded",
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    })
    .then(response => response.json())  // parses JSON response into native Javascript objects 
    .then((data) => {

        if (data.success) {
            $('#deleteItemModal').modal('toggle');

            alert(`Successfully delete an item`);
            
            $('#items-table').DataTable().ajax.reload();
        }

    });
};


const editItem = (item) => {
    let itemEditField = document.querySelector('#editItemField');

    // Display edit modal
    $('#editItemModal').modal('toggle');

    // Get the id and item of selected Item 
    let {id , item_name} = item;

    itemEditField.value = `${item_name}`;

    // Set item-id attribute this is the current id of the selected Item.
    itemEditField.setAttribute('item-id',id);
};


const editData = (url = `` , data = {}) => {
    return fetch(url, {
        method: "PUT", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // "Content-Type": "application/x-www-form-urlencoded",
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    })
    .then(response => response.json())  // parses JSON response into native Javascript objects 
    .then((data) => {

        if (data.success) {

            removeErrorMessage(editItemField , editItemErrorElement);

            $('#editItemModal').modal('toggle');

            alert('Item successfully updated!');

            $('#items-table').DataTable().ajax.reload();

            // Rebase the field.
            editItemField.value = ``;
        } else {

            addErrorMessage(editItemField , editItemErrorElement , 'This item is already in records.');

        }
    });
};



const postData = (url = `` , data = {}) => {
    let itemField  = document.querySelector('#itemName');
    return fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // "Content-Type": "application/x-www-form-urlencoded",
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    })
    .then(response => response.json())
    .then((data) => {
        if(data.success) {
            
            removeErrorMessage(itemField , errorElement);

            $('#items-table').DataTable().ajax.reload();
    
            alert('Item successfully add.');

            // Rebase the field
            itemField.value = ``;

        } else {

            addErrorMessage(itemField , errorElement , 'This item is already in records.');

        }
    }); // parses JSON response into native Javascript objects 
};

deleteItemFrm.addEventListener('submit' , (e) => {
    e.preventDefault();
    let route = document.URL; //http://selades.be/items


    const itemId = deleteItemFrm.getAttribute('item-id');

    // Prepare data needed for the request
    let data = {
        id:itemId,
        _token,
    };

    // Send request
    deleteData(`${route}/${data.id}` , data);
});
    
editItemFrm.addEventListener('submit' , (e) => {
    e.preventDefault();
    let route = document.URL; //http://selades.be/items

    let itemEditField = document.querySelector('#editItemField');
    
    // Data needed for request
    let data = {
        id : itemEditField.getAttribute('item-id'),
        item_name : itemEditField.value,
        _token,
    };

    // Send request
    editData(`${route}/${data.id}` , data);

});

addItemFrm.addEventListener('submit' , (e) => {
    e.preventDefault();
    let itemField  = document.querySelector('#itemName');
    let route    = document.URL; //http://selades.be/items

    postData(route , {item_name:itemField.value , _token:_token});
});

