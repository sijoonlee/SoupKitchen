const modalNewRecord = document.querySelector('#modal-create-new-record');
const btnCloseModalNewRecord = document.querySelector('#close-modal-create-new-record');
const btnSaveNewRecord = document.querySelector('#btn-save-new-record');
const btnCloseNewRecord = document.querySelector('#btn-close-new-record');

const modalUpdateRecord = document.querySelector('#modal-update-record');
const btnCloseModalUpdateRecord = document.querySelector('#close-modal-update-record');
const btnUpdateRecord = document.querySelector('#btn-update-record');
const btnDeleteRecord = document.querySelector('#btn-delete-record');
const btnCloseUpdateRecord = document.querySelector('#btn-close-update-record');

const btnUploadPic = document.querySelector('#btn-upload-pic');

const listGrid = document.querySelector('#list');




const APIURL = 'http://localhost:80'
//import * as apiCalls from './api';
//  async loadTodos(){
//     let todos = await apiCalls.getTodos();
//     this.setState({todos});
//  }

const createAnItem = async (newItem={}) => {
  //const token = localStorage.token
  return fetch(APIURL+'/products/create', {
        method: 'post',
        //withCredentials: true,
        //credentials: 'include',
        headers: new Headers({
        'Content-Type': 'application/json',
        //'Authorization': 'Bearer ' + token
        }),
        body: JSON.stringify(newItem)
    })
    .then(resp => {
      if(!resp.ok) {
        if(resp.status >=400 && resp.status < 500) {
          resp.json().then(data => {
            return {message: data.message};
            // throw err;
          })
        } else {
          return {message: 'Please try again later, server is not responding'};
          // throw err;
        }
      }
      return resp.json();
    })
}

const getAllItem = async () => {
  //const token = localStorage.token
  return fetch(APIURL+'/products', {
        method: 'get',
        //withCredentials: true,
        //credentials: 'include',
        headers: new Headers({
        'Content-Type': 'application/json',
        //'Authorization': 'Bearer ' + token
        })
    })
    .then(resp => {
      if(!resp.ok) {
        if(resp.status >=400 && resp.status < 500) {
          resp.json().then(data => {
            return {errorMessage: data.message};
            // throw err;
          })
        } else {
          return {message: 'Please try again later, server is not responding'};
          // throw err;
        }
      }
      return resp.json();
    })
}

const updateAnItem = async (item={}) => {
  //const token = localStorage.token
  return fetch(APIURL+'/products/updateQty', {
        method: 'post',
        //withCredentials: true,
        //credentials: 'include',
        headers: new Headers({
        'Content-Type': 'application/json',
        //'Authorization': 'Bearer ' + token
        }),
        body: JSON.stringify(item)
    })
    .then(resp => {
      if(!resp.ok) {
        if(resp.status >=400 && resp.status < 500) {
          resp.json().then(data => {
            return {message: data.message};
            // throw err;
          })
        } else {
          return {message: 'Please try again later, server is not responding'};
          // throw err;
        }
      }
      return resp.json();
    })
}

const deleteAnItem = async (product_id) => {
  //const token = localStorage.token
  return fetch(APIURL+'/products/delete?product_id=' + product_id, {
        method: 'get',
        //withCredentials: true,
        //credentials: 'include',
        headers: new Headers({
        'Content-Type': 'application/json',
        //'Authorization': 'Bearer ' + token
        })
    })
    .then(resp => {
      if(!resp.ok) {
        if(resp.status >=400 && resp.status < 500) {
          resp.json().then(data => {
            return {message: data.message};
            // throw err;
          })
        } else {
          return {message: 'Please try again later, server is not responding'};
          // throw err;
        }
      }
      return resp.json();
    })
}

const generateList = (data) => {
    let grid = 
    `<div class="grid-wrapper col-num-5 col-gap-p5 row-gap-p5">
        <div class="grid-heading">Id</div>
        <div class="grid-heading">Type</div>
        <div class="grid-heading">Name</div>
        <div class="grid-heading">Qty</div>
        <div class="grid-heading create-button-inside">
            <button id = "create-new-record">+</button>
        </div>`;
    data.forEach((item)=>{
        const list = 
        `<div class="grid-cell">${item.product_id}</div>
        <div class="grid-cell">${item.product_type}</div>
        <div class="grid-cell">${item.product_name}</div>
        <div class="grid-cell">
            <button class = "add-qty" data-id=${item.product_id} data-qty=${item.product_quantity}>+</button>
            <label>${item.product_quantity}</label>
            <button class = "subtract-qty" data-id=${item.product_id} data-qty=${item.product_quantity}>-</button>
        </div>
        <div class="grid-cell update-button-inside" >
            <button class="update-record" id=${item.product_id}
                    data-id=${item.product_id} data-type=${item.product_type} 
                    data-name=${item.product_name} data-qty=${item.product_quantity}>&#x26B2;</button>
        </div>`;
        grid += list;
    });
    grid += '</div>';
    return grid;
}


const updateList = async () => {
  data = await getAllItem();
  listGrid.innerHTML = generateList(data);

  document.querySelectorAll('.update-record').forEach( currentBtn => {
    currentBtn.addEventListener('click', ()=>{
      document.querySelector('#target-id').value = currentBtn.getAttribute('data-id');
      document.querySelector('#target-type').value = currentBtn.getAttribute('data-type');
      document.querySelector('#target-name').value = currentBtn.getAttribute('data-name');
      document.querySelector('#target-qty').value = currentBtn.getAttribute('data-qty');
      modalUpdateRecord.style.display = 'block';
    });
  });
  document.querySelector('#create-new-record').addEventListener('click', ()=>{
    modalNewRecord.style.display = 'block';
  });
  
  
  document.querySelectorAll('.add-qty').forEach( (currentBtn) => {
    currentBtn.addEventListener('click', async ()=>{    
      const result = await updateAnItem({ "product_id": currentBtn.getAttribute('data-id'), "product_quantity": parseInt(currentBtn.getAttribute('data-qty'))+1});
      currentBtn.setAttribute('data-qty', result.product_quantity);
      currentBtn.parentElement.children[1].innerHTML = result.product_quantity;
      currentBtn.parentElement.children[2].setAttribute('data-qty', result.product_quantity);
    })
  })
  
  document.querySelectorAll('.subtract-qty').forEach( (currentBtn) => {
    currentBtn.addEventListener('click', async ()=>{
      const result = await updateAnItem({ "product_id": currentBtn.getAttribute('data-id'), "product_quantity": parseInt(currentBtn.getAttribute('data-qty'))-1});
      currentBtn.parentElement.children[0].setAttribute('data-qty', result.product_quantity);
      currentBtn.parentElement.children[1].innerHTML = result.product_quantity;
      currentBtn.setAttribute('data-qty', result.product_quantity);
    })
  })

  document.querySelectorAll('.delete-record').forEach( (currentBtn) => {
    currentBtn.addEventListener('click', async ()=>{
      const result = await deleteAnItem(currentBtn.getAttribute('data-id'));
      await updateList();
    })
  })
}

window.addEventListener('load', async (event) => {
  await updateList();

  btnUploadPic.addEventListener('change', ()=>{
  
    if(btnUploadPic.files && btnUploadPic.files[0]){
      // console.log(btnUploadPic.files);
        // FileList [ File ]
      // console.log(btnUploadPic.files[0]); 
        // File { name: "photo-736230.jpeg", lastModified: 1581556990000, webkitRelativePath: "", size: 27768, type: "image/jpeg" }
      let img = document.querySelector('#new-itme-pic');
      img.src = URL.createObjectURL(btnUploadPic.files[0]);    
      console.log(img.src)
      base64 = btnUploadPic.files[0].convertToBase64

      let result;
      let reader = new FileReader();
      reader.onloadend = function() {
        result = reader.result
        console.log('RESULT', reader.result) // data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD
        
      }
      reader.readAsDataURL(btnUploadPic.files[0]);
    }
  });
  
  btnCloseUpdateRecord.addEventListener('click', ()=>{
    modalUpdateRecord.style.display = 'none';
  });

  btnCloseModalUpdateRecord.addEventListener('click', ()=> {
    modalUpdateRecord.style.display = 'none';
  });

  btnCloseModalNewRecord.addEventListener('click', ()=>{
    modalNewRecord.style.display = 'none';
  });

  btnCloseNewRecord.addEventListener('click', ()=>{
    modalNewRecord.style.display = 'none';
  });

  btnSaveNewRecord.addEventListener('click', async ()=>{
    req = {
        product_id: document.getElementById('entry-id').value,
        product_type: document.getElementById('entry-type').value,
        product_name: document.getElementById('entry-name').value,
        product_quantity: document.getElementById('entry-qty').value,
    }

    await createAnItem(req).then(res => {
        console.log(res);
    });

    await updateList();
  })


  btnUpdateRecord.addEventListener('click', async ()=>{
    req = {
        product_id: document.getElementById('target-id').value,
        product_type: document.getElementById('target-type').value,
        product_name: document.getElementById('target-name').value,
        product_quantity: document.getElementById('target-qty').value,
    }

    await updateAnItem(req).then(res => {
        console.log(res);
    });

    await updateList();
  })

  btnDeleteRecord.addEventListener('click', async ()=>{
    req = {
        product_id: document.getElementById('target-id').value
    }

    await deleteAnItem(req).then(res => {
        console.log(res);
    });

    await updateList();
  })

});




