const modal = document.querySelector('#modal-create-new-record');
const btnCreateNewRecord = document.querySelector('#create-new-record');
const btnCloseModal = document.querySelector('#close-modal-create-new-record');
const btnSaveNewRecord = document.querySelector('#btn-save-new-record');
const btnAddQty = document.querySelector("#btn-add-qty");
const APIURL = 'http://localhost:80';
//import * as apiCalls from './api';
//  async loadTodos(){
//     let todos = await apiCalls.getTodos();
//     this.setState({todos});
//  }
const createAnItem = async (newItem) => {
    //const token = localStorage.token
    return fetch(APIURL + '/products/create', {
        mode: "no-cors",
        method: 'post',
        //withCredentials: true,
        //credentials: 'include',
        headers: new Headers({
            'Content-Type': 'application/json',
            //'Authorization': 'Bearer ' + token
        }),
        body: JSON.stringify(newItem)
    }).then(resp => {
        if (!resp.ok)
        {
            if (resp.status >=400 && resp.status < 500)
            {
                resp.json().then(data => {
                    return {errorMessage: data.message};
                    // throw err;
                });
            }
            else
            {
                return {errorMessage: 'Please try again later, server is not responding'};
                // throw err;
            }
        }
        return resp.json();
    });
}
const updateItem = async (newItem = {}) => {
    return fetch(APIURL + "/products/edit", {
        mode: "no-cors",
        method: "post",
        headers: new Headers ({"Content-Type": "application/json"}),
        body: JSON.stringify(newItem)
    }).then(res => {
        if (!res.ok)
        {
            if (res.status >= 400 && res.status < 500)
            {
                res.json().then(data => {
                    return {errorMessage: data.message};
                    //throw err
                });
            }
            else
            {
                return {errorMessage: 'Please try again later, server is not responding'};
                //throw err
            }
        }
        return res.json();
    });
}

btnCreateNewRecord.addEventListener('click', () => {
    modal.style.display = 'block';
});

btnCloseModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

btnSaveNewRecord.addEventListener('click', async (req, res) => {
    req = {
        id: document.getElementById('entry-id').value,
        type: document.getElementById('entry-type').value,
        name: document.getElementById('entry-name').value,
        qty: document.getElementById('entry-qty').value,
    }
    await createAnItem(req).then(res => {
        console.log(res);
    });    
});

btnAddQty.addEventListener("click", async (req, res) => {
    var newQty = parseInt(document.getElementById("current-qty").innerHTML);
    newQty++;
    req = {qty: newQty};
    await updateItem(req).then(res => {
        console.log(res);
    });
});