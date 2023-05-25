const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

const listUniversity = async () => {
  const data = await fetch(
    baseURL + 'universityControllers.php?typeForm=get_all_university'
  )

  const response = await data.text()

  tbody.innerHTML = response
}

listUniversity()

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'universityControllers.php?typeForm=create_university',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNew.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardForm.reset()
    listUniversity()
  }

  listUniversity()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idUniversity) {
  await fetch(
    baseURL +
      'universityControllers.php?typeForm=delete_university&idUniversity=' +
      idUniversity
  )
  listUniversity()
}

function deleteUniversity(idUniversity) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar está universidade?',
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
        confirmDelete(idUniversity)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'University foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O universidade não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeUniversity(idUniversity) {
  const dataUsers = await fetch(
    baseURL +
      'universityControllers.php?typeForm=get_university&idUniversity=' +
      idUniversity
  )

  const response = await dataUsers.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const universityData = response['dados']
    const cardModal = document.getElementById('editeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_edit').value = universityData.id
    document.getElementById('name_university_edit').value =
      universityData.name_university
    document.getElementById('ref_university_edit').value =
      universityData.ref_university
  }
}
async function seeUniversity(idUniversity) {
  const dataUsers = await fetch(
    baseURL +
      'universityControllers.php?typeForm=get_university&idUniversity=' +
      idUniversity
  )

  const response = await dataUsers.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const universityData = response['dados']
    const cardModal = document.getElementById('seeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('id_see').value = universityData.id
    document.getElementById('name_university_see').value =
      universityData.name_university
    document.getElementById('ref_university_see').value =
      universityData.ref_university
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
    baseURL + 'universityControllers.php?typeForm=edite_university',
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

  listUniversity()
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
