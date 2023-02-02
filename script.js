// fungsi untuk melarang user mengetik spesial karakter dan memberi spasi pada inputan username
$(document).ready(function () {
  $("#username").on({
    keydown: function (e) {
      if (e.which === 32) return false;
      var regex = new RegExp("^[a-zA-Z0-9!@#$%^&()\b]+$");
      var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (!regex.test(key)) {
        e.preventDefault();
        return false;
      }
    },
    keyup: function () {
      this.value = this.value.toLowerCase();
    },
    change: function () {
      this.value = this.value.replace(/\s/g, "");
      this.value = this.value.replace(/[^a-z0-9!@#$%^&()]+/g, "");
    },
  });
});
// fungsi untuk melarang user memberi spasi pada inputan password
$(document).ready(function () {
  $("#passwordInput, #cpasswordInput").on({
    keydown: function (e) {
      if (e.which === 32) return false;
    },
    change: function () {
      this.value = this.value.replace(/\s/g, "");
    },
  });
});
// fungsi untuk memeriksa dan memberi peringatan jika username tidak memenuhi syarat
function validateUsername() {
  var username = document.getElementById("username").value;
  var warning = document.getElementById("warning-username");
  if (username.length < 5 || username.length > 16) {
    warning.style.display = "block";
  } else {
    warning.style.display = "none";
  }
}
// fungsi untuk memeriksa dan memberi peringatan jika password tidak memenuhi syarat
function validatePassword() {
  var passin = document.getElementById("passwordInput").value;
  var pattern = new RegExp(
    /^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-zA-Z0-9!@#\$%\^&\*])[a-zA-Z0-9!@#\$%\^&\*]{8,20}$/
  );
  var warning = document.getElementById("warning-password");
  if (!pattern.test(passin) || passin.length < 8 || passin.length > 16) {
    warning.style.display = "block";
  } else {
    warning.style.display = "none";
  }
}
// fungsi untuk memeriksa apakah confirm password sudah sama dengan password
function validatecPassword() {
  var passin = document.getElementById("passwordInput").value;
  var cpassin = document.getElementById("cpasswordInput").value;
  var warning = document.getElementById("warning-cpassword");
  if (cpassin !== passin) {
    warning.style.display = "block";
  } else {
    warning.style.display = "none";
  }
}
// fungsi untuk hide/unhide password
function hideunhide() {
  var x = document.getElementById("passwordInput");
  var y = document.getElementsByClassName("password-icon")[0];
  if (x.type === "password") {
    x.type = "text";
    y.classList.remove("bi-eye-fill");
    y.classList.add("bi-eye-slash");
  } else {
    x.type = "password";
    y.classList.remove("bi-eye-slash");
    y.classList.add("bi-eye-fill");
  }
}
// fungsi untuk hide/unhide confirm password
function chideunhide() {
  var x = document.getElementById("cpasswordInput");
  var y = document.getElementsByClassName("cpassword-icon")[0];
  if (x.type === "password") {
    x.type = "text";
    y.classList.remove("bi-eye-fill");
    y.classList.add("bi-eye-slash");
  } else {
    x.type = "password";
    y.classList.remove("bi-eye-slash");
    y.classList.add("bi-eye-fill");
  }
}
