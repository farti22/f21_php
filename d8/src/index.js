document.addEventListener("DOMContentLoaded", function (_) {
    const inputId = document.querySelector('.input-id');
    const aEdit = document.querySelector('.edit');
    const editHref = aEdit.href;
    const aDelete = document.querySelector('.delete');
    const deleteHref = aDelete.href;
    inputId.addEventListener('input', function (e) {
        let {
            target
        } = e;
        if (target.value != "") {
            aEdit.href = editHref + '&' + target.value;
            aDelete.href = deleteHref + '&' + target.value;
            console.log(aEdit.href);
            aEdit.classList.remove("blocked");
            aDelete.classList.remove("blocked");
        } else {
            aEdit.classList.add("blocked");
            aDelete.classList.add("blocked");
        }
        console.log(target.value);
    });

});