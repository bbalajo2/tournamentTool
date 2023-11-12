let copyToClipboard = document.getElementById('copyButton');

copyToClipboard.addEventListener('click', () => {
    let URL = $(location).attr('href');
    if(navigator.clipboard) {
        navigator.clipboard.writeText(URL).then(() => {
            alert('URL copied to clipboard successfully')
        })
    } 
})