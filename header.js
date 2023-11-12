function getColour() {
    let cookieContents = getCookie("colourTheme").toString();
    if (cookieContents == "dark") {
        changeColour('dark');
    } else if (cookieContents == "light") {
        changeColour('light');
    }
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + "; path=/";
}

function changeColour(themeMode) {

    if (themeMode == "dark") {
        document.getElementById("colourTheme").href = "noticeboard-dark.css";
        setCookie('colourTheme', 'dark', 10);
        alert("Please refresh to change the colour theme.");

    } else if (themeMode == "light") {
        document.getElementById("colourTheme").href = "noticeboard.css";
        setCookie('colourTheme', 'light', 10);
        alert("Please refresh to change the colour theme.");
    }

}

const d = new Date();
let minutes = d.getMinutes();
minutes = minutes <= 9 ? '0' + minutes : minutes;
document.getElementById("getTime").innerHTML = d.getHours() + ":" + minutes;