const activityLogElement        = document.querySelector('#activity-logs');
const instructionMessageElement = document.querySelector('#instruction-message');


// A function attached to a element with onClick attribute
const requestArchieves = (date) => {
    const route = document.URL;
    // requestArchiveData -> onSuccess -> displayData
    requestArchiveData(`${route}/${date}`);
};

const requestArchiveData = (url = '' , data = {}) => {
    //request a data
      return fetch(url, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // "Content-Type": "application/x-www-form-urlencoded",
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
    })
    .then(response => response.json())  // parses JSON response into native Javascript objects 
    .then((data) => {
        displayData(data);
    });
};

const displayData = (archives) => {

    // Clear first before display new data
    activityLogElement.innerHTML        = ``;
    instructionMessageElement.innerHTML = ``;

    // Iterate and display all logs
    archives.activity_logs.map((data) => {

        // Modify App in Data Context
        data.subject_type = data.subject_type.replace('App\\' ,'');
        data.causer_type  = data.causer_type != null ? data.causer_type.replace('App\\' ,'') : 'System';

        // Push new element
        activityLogElement.innerHTML += `
        <tr>
            <td class=' card card-body rounded-0'>
            ${data.causer_type} ${data.description} a ${data.subject_type}<span class='font-weight-bold'>${data.created_at}</span>
            </td>
        </tr>`;

    });

};

