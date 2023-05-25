const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')
const universitySelect = document.getElementById('universitySelect')
const universityEditSelect = document.getElementById('university_select_edit')

const listFaculty = async () => {
  const data = await fetch(
    baseURL + 'facultyControllers.php?typeForm=get_all_faculty'
  )
  const response = await data.text()
  tbody.innerHTML = response
}

const listUniversity = async () => {
  await fetch(baseURL + 'facultyControllers.php?typeForm=get_all_university')
    .then(response => response.json())
    .then(data => {
      // Itera sobre os dados retornados e adiciona opções ao select
      data.forEach(row => {
        const option = document.createElement('option')
        const optionEdit = document.createElement('option')
        option.text = row.name_university
        option.value = row.name_university
        optionEdit.value = row.name_university
        optionEdit.text = row.name_university
        universitySelect.add(option)
        universityEditSelect.add(optionEdit)
      })
    })
    .catch(error => console.error('Erro:', error))
}

listUniversity()
listFaculty()

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'facultyControllers.php?typeForm=create_faculty',
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
    listFaculty()
  }

  listFaculty()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idFaculty) {
  await fetch(
    baseURL +
      'facultyControllers.php?typeForm=delete_faculty&idFaculty=' +
      idFaculty
  )
  listFaculty()
}

function deleteFaculty(idFaculty) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar está faculdade?',
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
        confirmDelete(idFaculty)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Faculty foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A faculdade não foi excluído :)',
          'error'
        )
      }
    })
}
async function editeFaculty(idFaculty) {
  const dataFetch = await fetch(
    baseURL +
      'facultyControllers.php?typeForm=get_faculty&idFaculty=' +
      idFaculty
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const facultyData = response['dados']
    const cardModal = document.getElementById('editeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_edit').value = facultyData.id
    document.getElementById('name_faculty_edit').value =
      facultyData.name_faculty
    document.getElementById('ref_faculty_edit').value = facultyData.ref_faculty
    document.getElementById('university_select_edit').value =
      facultyData.name_university
  }
}
async function seeFaculty(idFaculty) {
  const dataFetch = await fetch(
    baseURL +
      'facultyControllers.php?typeForm=get_faculty&idFaculty=' +
      idFaculty
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const facultyData = response['dados']
    const cardModal = document.getElementById('seeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('id_see').value = facultyData.id
    document.getElementById('name_faculty_see').value = facultyData.name_faculty
    document.getElementById('ref_faculty_see').value = facultyData.ref_faculty
    document.getElementById('select_university_see').value =
      facultyData.name_university
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
    baseURL + 'facultyControllers.php?typeForm=edite_faculty',
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

  listFaculty()
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
