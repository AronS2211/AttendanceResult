function showAlbum(input) {
    var ipval = input.value;
    if (ipval == "") {
        document.getElementById("album").innerHTML = "";
        return;
    } else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("album").innerHTML = this.responseText;
            }
        };
        xhr.open('GET', 'assets/ajax/fetch_album.php?q=' + ipval, true);
        xhr.send();
    }
}