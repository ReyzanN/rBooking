function SearchAjax(Element,APIUrl,ResultDiv,XCSRFTOKEN){
    const XHR = new XMLHttpRequest()
    let Form = new FormData
    Form.append('data', Element)
    let resultDiv = document.getElementById(ResultDiv)
    XHR.onreadystatechange = async function (){
        if (XHR.DONE === XMLHttpRequest.DONE){
            resultDiv.innerHTML = XHR.responseText
        }
    }
    XHR.open('POST', APIUrl)
    XHR.setRequestHeader('X-CSRF-TOKEN',XCSRFTOKEN)
    XHR.setRequestHeader('X-Requested-With','XMLHttpRequest')
    XHR.send(Form)
}
