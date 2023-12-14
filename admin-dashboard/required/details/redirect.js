function user(){
    window.location.href = "/PawPointment-Final/PawPointment/admin-dashboard/login-form/index.php";
}

function calendar(){
  window.location.href = "/PawPointment-Final/PawPointment/admin-dashboard/index.php";
}

function signout() {
  Swal.fire({
    title: "Are you sure?",
    text: "You are about to sign out. Do you want to continue?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      swal({
        title: "SUCCESS",
        text: "Successfully Signed Out",
        type: "success",
        timer: 2000,
        showCancelButton: false,
        showConfirmButton: false,
      }, function () {
        window.location.href = "/PawPointment-Final/PawPointment/admin-dashboard/required/navigation/logout.php";
      });
    }
  });
}


signOutLink.addEventListener("click", function (event) {
  event.preventDefault();
  signout();
});