
function html_table_to_excel(type) {
    var data1 = document.getElementById('dataTable');
    var data2 = document.getElementById('analysisTable');

    var file = XLSX.utils.table_to_book(data1, {
        sheet: "sheet1"
    });

    var file2 = XLSX.utils.table_to_book(data2, {
        sheet: "sheet1"
    });

    XLSX.utils.book_append_sheet(file, file2.Sheets[file2.SheetNames[0]], "Sheet2");

    XLSX.write(file, {
        bookType: type,
        bookSST: true,
        type: 'base64'
    });

    XLSX.writeFile(file, 'report.' + type);
}

const export_button = document.getElementById('csv');

export_button.addEventListener("click", () => {
    html_table_to_excel('xlsx');
});

var btn = document.getElementById("pdf");
var createpdf = document.getElementById("report");
var opt = {
    margin: 0.25,
    filename: 'report.pdf',
    html2canvas: {
        scale: 2
    },
    jsPDF: {
        unit: 'in',
        format: 'A4',
        orientation: 'portrait'
    }
};
btn.addEventListener("click", function () {
    html2pdf().set(opt).from(createpdf).save();
});
$('#course').on('change', function () {
    var cls_id = this.value;
    // console.log(country_id);
    $.ajax({
        url: 'ajax/course.php',
        type: "POST",
        data: {
            c: cls_id
        },
        success: function (result) {
            $('#dept').html(result);
        }
    })
});
//
$('#dept').on('change', function () {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    $.ajax({
        url: 'ajax/dept.php',
        type: "POST",
        data: {
            c: c,
            d: d
        },
        success: function (result) {
            $('#sem').html(result);
            // console.log(data);
        }
    })
});
//
$('#sem').on('change', function () {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    var s = this.options[this.selectedIndex].getAttribute("sem");
    $.ajax({
        url: 'ajax/sem.php',
        type: "POST",
        data: {
            c: c,
            d: d,
            s: s
        },
        success: function (result) {
            $('#en').html(result);
            // console.log(data);
        }
    })
});
//
$('#en').on('change', function () {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    var s = this.options[this.selectedIndex].getAttribute("sem");
    var en = this.options[this.selectedIndex].getAttribute("en");
    console.log(c);
    console.log(d);
    console.log(s);
    console.log(en);
    $.ajax({
        url: 'ajax/ename.php',
        type: "POST",
        data: {
            c: c,
            d: d,
            s: s,
            en: en
        },
        success: function (result) {
            $('#sb').html(result);
            console.log(result);
        }
    })
});
//
$('#sb').on('change', function () {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    var s = this.options[this.selectedIndex].getAttribute("sem");
    var en = this.options[this.selectedIndex].getAttribute("en");
    var sb = this.options[this.selectedIndex].getAttribute("sb");
    console.log(c);
    console.log(d);
    console.log(s);
    console.log(en);
    console.log(sb);
    $.ajax({
        url: 'ajax/sub.php',
        type: "POST",
        data: {
            c: c,
            d: d,
            s: s,
            en: en,
            sb: sb
        },
        success: function (result) {
            $('#rn').html(result);
            console.log(result);
        }
    })
});
