const baseURL = '/base/controllers/'
const dashboardURL = '/dashboard/controllers/'

const cardForm = document.getElementById('registerForm')

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
