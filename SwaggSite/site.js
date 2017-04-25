function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// Custom datatable filter
$.fn.dataTable.ext.search.push(
function (settings, data, dataIndex) {
    var index = document.getElementById("CategoryFilter").selectedIndex;
    switch (index) {
        case 0:
            if (data[2] === "0")
                return true;
            break;
        case 1:
            if (data[2] === "1")
                return true;
            break;
        case 2:
            if (data[2] === "2")
                return true;
            break;
        case 3:
            if (data[2] === "3")
                return true;
            break;
        case 4:
            if (data[2] === "4")
                return true;
            break;
        case 5:
            if (data[2] === "5")
                return true;
            break;
        case 6:
            if (data[2] === "6")
                return true;
            break;
        case 7:
            if (data[2] === "7")
                return true;
            break;
        case 8:
            if (data[2] === "8")
                return true;
            break;
        case 9:
            return true;
        default:
            return false;
    }
    return false;
}
);