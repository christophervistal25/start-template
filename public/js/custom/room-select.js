let checkInModalFrm = document.querySelector('#checkInFrm');

// Don't remove the initialization cause it will cause an error for detecting
// if has a value or not.
let checkIns        = document.querySelectorAll('.customerCheckIns');

const _token  = document.getElementsByName('csrf-token')[0]
                               .getAttribute('content');


const numberFormat = (number) => {
    return ("0" + number).slice(-2);
};

let timeDiffernce = (dateTime,element) => {
    let days , hours , minutes , seconds;
        setInterval(() => {
            let customerTimeCheckIn = parseInt(new Date(Date.parse(dateTime)).getTime());

            let timeNow = new Date().getTime();

            let timeSpend = (parseInt(timeNow) - customerTimeCheckIn) / 1000;

            days = parseInt(timeSpend / 86400);

            timeSpend = (timeSpend % 86400);

            hours = numberFormat(parseInt(timeSpend / 3600));

            timeSpend = (timeSpend % 3600);

            minutes = numberFormat(parseInt(timeSpend / 60));

            timeSpend = (timeSpend % 60);

            seconds = numberFormat(parseInt(timeSpend));
            
            element.innerHTML = `D:${parseInt(days,10)} H:${hours} M:${minutes} S:${seconds}`;
            
    } , 1000);
};


let getAllCheckInsElement = () => {

    let interval = setInterval(() => {
        checkIns = document.querySelectorAll('.customerCheckIns');
        if (checkIns.length != 0) {
            clearInterval(interval);
            checkIns.forEach((element , index) => {
                    let timeCheckIn = element.innerText;

                    let timeSpendElement = document.querySelector(`#timeSpend${index+1}`);
                    timeDiffernce(timeCheckIn,timeSpendElement);
            });
        }
    }, 1000);
    
};

// Get all check ins and display a time spend timer
getAllCheckInsElement();

const getCheckInModalFrmData = () => {
    return [
            document.querySelector('#customerName').value ,
            document.querySelector('#customerPhoneNumber').value ,
            document.querySelector('#roomNumber').value , 
            document.querySelector('#roomType').value
        ];
};

const postCheckIn = (url = `` , data = {}) => {
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
        if (data.success) {

            $('#checkInModal').modal('toggle');

            // When the request is sucecss refresh the data tables
            $('#checkins-table').DataTable().ajax.reload();

        }
    }); // parses JSON response into native Javascript objects 
};


checkInModalFrm.addEventListener('submit' , (e) => {
    e.preventDefault();

    // Get data of the form
    const [customerName , customerPhoneNumber , roomNumber , roomType] = getCheckInModalFrmData();
    
    // Preprare a data for request
    let data = {
            _token,
            customer_name : customerName,
            customer_phone_number : customerPhoneNumber,
            room_number : roomNumber,
            room_type : roomType
        };

    // Http request or ajax
    let route = document.URL;
    postCheckIn(route , data);
}); 

