const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

searchRegisterForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(searchRegisterForm)
  dataForm.append('add', 1)

  const dataFetch = await fetch(
    baseURL +
      'teamControllers.php?typeForm=get_all_team_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listTeam(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    cardForm.reset()
  }
})

const listTeam = async limitRegister => {
  const data = await fetch(
    baseURL +
      'teamControllers.php?typeForm=get_all_team&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  tbody.innerHTML = response
}
listTeam(numRegister.value)

numRegister.addEventListener('change', () => {
  listTeam(numRegister.value)
})

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)

  const dataFetch = await fetch(
    baseURL + 'teamControllers.php?typeForm=create_team',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataFetch.json()

  if (response['error']) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: response['msg'],
      showConfirmButton: false,
      timer: 3500
    })
  } else {
    Swal.fire({
      icon: 'success',
      title: response['msg'],
      showConfirmButton: false,
      timer: 3500
    })

    setTimeout(() => {
      cardForm.reset()
      window.location.href = '/'
    }, 3000)
  }
})

async function confirmDelete(idTeam) {
  await fetch(
    baseURL + 'teamControllers.php?typeForm=delete_team&idTeam=' + idTeam
  )
  listTeam()
}

function deleteTeam(idTeam) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar está equipa?',
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
        confirmDelete(idTeam)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Team foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A equipa não foi excluído :)',
          'error'
        )
      }
    })
}
async function seeTeam(idTeam) {
  const dataFetch = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_team&idTeam=' + idTeam
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const teamData = response['dados']
    const cardModal = document.getElementById('seeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('id_see').value = teamData.id
    document.getElementById('name_team_see').value = teamData.name_team
    document.getElementById('ref_team_see').value = teamData.ref_team
    document.getElementById('select_faculty_see').value = teamData.name_faculty
  }
}
