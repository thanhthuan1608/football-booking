function validateField(){
    let name = document.getElementById("field_name").value;

    if(name.trim() === ""){
        alert("Tên sân không được để trống");
        return false;
    }

    return true;
}