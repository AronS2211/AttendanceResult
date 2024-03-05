function checkAllCheckboxes() {
    var checkAllCheckbox = document.getElementById("checkAll");
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
}
// 
function studentCheckboxes() {
    var checkAllCheckbox = document.getElementById("stucheckAll");
    var checkboxes = document.querySelectorAll('.student-cls input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });

    document.getElementById("parcheckAll").checked = checkAllCheckbox.checked;

}

function staffCheckboxes() {
    var checkAllCheckbox = document.getElementById("stacheckAll");
    var checkboxes = document.querySelectorAll('.staff-cls input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
}
function parentCheckboxes() {
    var checkAllCheckbox = document.getElementById("parcheckAll");
    var checkboxes = document.querySelectorAll('.parent-cls input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
}
function commonCheckboxes() {
    var checkAllCheckbox = document.getElementById("comcheckAll");
    var checkboxes = document.querySelectorAll('.common-cls input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
}