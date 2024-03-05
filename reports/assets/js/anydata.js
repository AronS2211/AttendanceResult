
$(() => {
    $("#searchbtn").click(function (ev) {
        ev.preventDefault();
        var form = $("#reportform");
        var url = './ajax/getreport.php';
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                $("#reporttable").html(data);
            },
            error: function (data) {
                alert("some  Error");
            }
        });

    });

});


function exportpdf() {
    var form = document.getElementById('reportform');
    form.action = './ajax/export_pdf.php';
    form.method = 'post';
    form.submit();
}

function exportexcel() {
    var form = document.getElementById('reportform');
    form.action = './ajax/export_excel.php';
    form.method = 'post';
    form.submit();
}

document.getElementById('First Name').checked = true;
document.getElementById('Last Name').checked = true;