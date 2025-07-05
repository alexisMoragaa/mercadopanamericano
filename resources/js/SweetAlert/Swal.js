import Swal from 'sweetalert2';

// Check if the sessionMessage is set in the window object
if(window.sessionMessage) {
    Swal.fire({
        title: window.sessionMessage.title,
        text: window.sessionMessage.text,
        icon: window.sessionMessage.type,
    });
}

document.addEventListener("DOMContentLoaded", function () {
  Livewire.on("swal-info-message", (data) => {
    console.log(data);
      Swal.fire({
          title: data[0].title,
          text: data[0].message,
          icon: data[0].type,
      });
  });
});



window.addEventListener('swal:confirmForm', event => {
    const submitButton = document.querySelector("button[type='submit']");

    Swal.fire({
        title: event.detail[0].title,
        html: event.detail[0].text,
        icon: event.detail[0].type,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Continuar"
        }).then((result) => {
            if (result.isConfirmed) {

                submitButton.disabled = true;

                const component = Livewire.find(event.detail[0].component);
                component.dispatch(event.detail[0].action);
            }
        });
})