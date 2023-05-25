const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')
const universitySelect = document.getElementById('universitySelect')
const universityEditSelect = document.getElementById('university_select_edit')

const listTeam = async () => {
  const data = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_all_team'
  )
  const response = await data.text()
  tbody.innerHTML = response
}

const listUniversity = async () => {
  await fetch(baseURL + 'teamControllers.php?typeForm=get_all_university')
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
listTeam()

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'teamControllers.php?typeForm=create_team',
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
    listTeam()
  }

  listTeam()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function editeTeam(idTeam) {
  const dataFetch = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_team&idTeam=' + idTeam
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const teamData = response['dados']
    const cardModal = document.getElementById('editeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_edit').value = teamData.id
    document.getElementById('name_team_edit').value = teamData.name_team
    document.getElementById('ref_team_edit').value = teamData.ref_team
    document.getElementById('university_select_edit').value =
      teamData.name_university
  }
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
    document.getElementById('select_university_see').value =
      teamData.name_university
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
    baseURL + 'teamControllers.php?typeForm=edite_team',
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

  listTeam()
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
