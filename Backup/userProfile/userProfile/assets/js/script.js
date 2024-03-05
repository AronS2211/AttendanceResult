document.addEventListener("DOMContentLoaded", function () {
    var inputElements = document.querySelectorAll('.TT-form input');
    var selectElements = document.querySelectorAll('.TT-form select');
    var buttonElements = document.querySelectorAll('.TT-form button[type="submit"]');

    // Combine the NodeLists using the spread operator
    var basicInfoInputs = [...inputElements, ...selectElements, ...buttonElements];

    basicInfoInputs.forEach(function (input) {
        input.disabled = true;
    });

});

function showreligion() {
    var type = document.getElementById('religion').value;
    if (type == 'others') {
        document.getElementById('otherReligion').style.display = 'flex';
    } else {
        document.getElementById('otherReligion').style.display = 'none';
    }
}

function showform(fid) {
    var forms = document.getElementsByClassName('TT-form');
    for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = 'none';
    }

    var tabs = document.getElementsByClassName('tab');
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove('active');
    }

    document.getElementById(fid).style.display = 'flex';
    document.getElementById(fid + '-tab').classList.add('active');
}




function enableInputs(containerId) {
    // Get the container element by ID
    var container = document.getElementById(containerId);

    if (!container) {
        console.error("Container not found with ID: " + containerId);
        return;
    }

    // Find input elements within the container
    var inputElements = container.querySelectorAll('input');
    var selectElements = container.querySelectorAll('select');
    var buttonElements = container.querySelectorAll('button[type="submit"]');

    // Combine the NodeLists using the spread operator
    var specificInputs = [...inputElements, ...selectElements, ...buttonElements];

    // Enable the specific inputs
    specificInputs.forEach(function (input) {
        if (input.disabled == true) {
            input.disabled = false;
        } else {
            input.disabled = true;
        }
    });
}


