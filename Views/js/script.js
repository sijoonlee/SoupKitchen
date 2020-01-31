const modal = document.querySelector('#modal-create-new-record');
const btnCreateNewRecord = document.querySelector('#create-new-record');
const btnSaveNewRecord = document.querySelector('#save-new-record');
const btnCloseModal = document.querySelector('#close-modal-create-new-record');

btnCreateNewRecord.addEventListener('click', ()=>{
    console.log("clicked")
    modal.style.display = 'block';
});

btnCloseModal.addEventListener('click', ()=>{
    modal.style.display = 'none';
});



// btnSaveNewRecord.addEventListener('click', saveNewRecord);

