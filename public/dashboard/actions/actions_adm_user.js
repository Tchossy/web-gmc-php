const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCad')

const btnExit = document.getElementById('btn_exit')

const listUsers = async () => {
  const dataUsers = await fetch(
    baseURL + 'admUserControllers.php?typeForm=get_utentes'
  )

  const response = await dataUsers.text()

  tbody.innerHTML = response
}

listUsers()

cardForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'admUserControllers.php?typeForm=create_utente',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardForm.reset()
    listUsers()
  }

  listUsers()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idUtente) {
  await fetch(
    baseURL +
      'admUserControllers.php?typeForm=delete_utentes&idUtente=' +
      idUtente
  )
  listUsers()
}

function deleteUtente(idUtente) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este utente?',
      text: 'Você não será capaz de reverter está acção!',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showCancelButton: true,
      confirmButtonText: 'Sim, exclua!',
      cancelButtonText: 'Não, cancelar!',
      reverseButtons: true
    })
    .then(result => {
      if (result.isConfirmed) {
        confirmDelete(idUtente)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Utente foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O utente não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeUtente(idUtente) {
  const dataUsers = await fetch(
    baseURL + 'admUserControllers.php?typeForm=get_utente&idUtente=' + idUtente
  )

  const response = await dataUsers.json()
  if (response['error']) {
    alert(response['msg'])
  } else {
    const utenteData = response['dados']
    const cadModal = document.getElementById('userEditeModal')

    cadModal.style.visibility = 'visible'
    cadModal.classList.add('show')

    // console.log(response['dados'])

    let namePermission = ''

    // if (utenteData.permissions_adm == 'read') {
    //   namePermission = 'Apenas leitura'
    // } else if (utenteData.permissions_adm == 'write') {
    //   namePermission = 'Apenas cadastrar'
    // } else if (utenteData.permissions_adm == 'all_permissions') {
    //   namePermission = 'Todas as permissões'
    // }

    document.getElementById('id_edit').value = utenteData.id
    document.getElementById('full_name_adm_edit').value =
      utenteData.full_name_adm
    document.getElementById('email_address_adm_edit').value =
      utenteData.email_address_adm
    document.getElementById('permissions_adm').value =
      utenteData.permissions_adm
    document.getElementById('number_phone_adm_edit').value =
      utenteData.number_phone_adm
  }
}

cardEditForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditForm)

  // for (var dados of dataEditForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataEditForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'admUserControllers.php?typeForm=edite_utente',
    {
      method: 'POST',
      body: dataEditForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgEditAlerta.innerHTML = response['msg']
  } else {
    msgEditAlerta.innerHTML = response['msg']
  }

  listUsers()
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
