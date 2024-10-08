function setAction(action) {
    event.preventDefault();

    
    
    console.log("El script se ha ejecutado");
    document.getElementById('form').action = action;
    document.getElementById('form').submit();
}