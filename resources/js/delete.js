$(document).ready(function() {
    console.log('jquery is ready');

    $('.delete').click(function()
    {



      const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
  title: confirmDelete,
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Tak",
  cancelButtonText: "Nie",
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

 
      $.ajax({
      method: "DELETE",
      url: deleteUrl + $(this).data("id"),
      data: { id: $(this).data("id") }
      })
       .done(function(data) {
        window.location.reload();
       
     })

     .fail(function(data) {
      //console.log(data.responseJSON.message);
      Swal.fire({
      icon: data.responseJSON.status,
      title: "Oops...",
      text: data.responseJSON.message,
      footer: '<a href="#">Why do I have this issue?</a>'
      });
     });

   
  } 
  
});








     
   })


            })
