const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

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
      'courseControllers.php?typeForm=get_all_course_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listCourse(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    cardForm.reset()
  }
})

const listCourse = async limitRegister => {
  const data = await fetch(
    baseURL +
      'courseControllers.php?typeForm=get_all_course&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  tbody.innerHTML = response
}
listCourse(numRegister.value)

const listFaculty = async () => {
  await fetch(baseURL + 'courseControllers.php?typeForm=get_all_faculty')
    .then(response => response.json())
    .then(data => {
      const facultySelect = document.getElementById('facultySelect')
      const facultyEditSelect = document.getElementById('faculty_select_edit')

      // Itera sobre os dados retornados e adiciona opções ao select
      data.forEach(row => {
        const option = document.createElement('option')
        const optionEdit = document.createElement('option')
        option.text = row.name_faculty
        option.value = row.name_faculty
        optionEdit.text = row.name_faculty
        optionEdit.value = row.name_faculty

        facultySelect.add(option)
        facultyEditSelect.add(optionEdit)
      })
    })
    .catch(error => console.error('Erro:', error))
}
listFaculty()

numRegister.addEventListener('change', () => {
  listCourse(numRegister.value)
})

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'courseControllers.php?typeForm=create_course',
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
    listCourse()
  }

  listCourse()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idCourse) {
  await fetch(
    baseURL +
      'courseControllers.php?typeForm=delete_course&idCourse=' +
      idCourse
  )
  listCourse()
}

function deleteCourse(idCourse) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este curso?',
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
        confirmDelete(idCourse)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Course foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O curso não foi excluído :)',
          'error'
        )
      }
    })
}
async function seeCourse(idCourse) {
  const dataFetch = await fetch(
    baseURL + 'courseControllers.php?typeForm=get_course&idCourse=' + idCourse
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const courseData = response['dados']
    const cardModal = document.getElementById('seeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('id_see').value = courseData.id
    document.getElementById('name_course_see').value = courseData.name_course
    document.getElementById('ref_course_see').value = courseData.ref_course
    document.getElementById('select_faculty_see').value =
      courseData.name_faculty
  }
}

async function editeCourse(idCourse) {
  const dataFetch = await fetch(
    baseURL + 'courseControllers.php?typeForm=get_course&idCourse=' + idCourse
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const courseData = response['dados']
    const cardModal = document.getElementById('editeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_edit').value = courseData.id
    document.getElementById('name_course_edit').value = courseData.name_course
    document.getElementById('ref_course_edit').value = courseData.ref_course
    document.getElementById('faculty_select_edit').value =
      courseData.name_faculty
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
    baseURL + 'courseControllers.php?typeForm=edite_course',
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

  listCourse()
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
