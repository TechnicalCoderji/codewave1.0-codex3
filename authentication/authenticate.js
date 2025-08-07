
let form = document.getElementById('signup-form') || document.getElementById('login-form') || document.getElementById('admin-login-form') || document.getElementById('forgot-password-form') || document.getElementById('reset-password-form') || document.getElementById('resend-email-form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let captchaImage = document.getElementById("captcha-img");

    let loading = document.querySelector('.loading-wrapper');
    loading.style.zIndex = '1000';
    loading.style.opacity = '1';

    let formData = new FormData(form);

    if (form.id == 'login-form') {

        fetch('authentication/login-form.php', {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {

                // Hinding the loading animation
                loading.style.opacity = 0;
                loading.style.zIndex = '-1';

                if (data.status == "success") {
                    form.reset();
                    captchaImage.src = "authentication/captcha.php?" + Date.now();
                    window.location.href = 'dashboard.php';
                }
                else {
                    Swal.fire({
                        icon: data.status,
                        title: data.title,
                        text: data.message,
                        showConfirmButton: true
                    });
                }


            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error
                })
                loading.style.opacity = 0;
                loading.style.zIndex = '-1';
            })
        }
    else if (form.id == 'signup-form') 
    {
        fetch("authentication/signup-form.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {

                if (data.status == "success") {
                    form.reset();
                    captchaImage.src = "authentication/captcha.php?" + Date.now();
                }

                // Hinding the loading animation
                loading.style.opacity = 0;
                loading.style.zIndex = '-1';

                Swal.fire({
                    icon: data.status,
                    title: data.title,
                    text: data.message,
                    showConfirmButton: true
                });

            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error
                })
                loading.style.opacity = 0;
                loading.style.zIndex = '-1';
            })
    }
    else {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Form not recognized"
        });
        return;
    }

});


// Toggle password visibility

const togglePassword = document.getElementById("togglePassword");
const passwordField = document.getElementById("password");

togglePassword.addEventListener("click", function () {
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    const icon = this.querySelector("i");
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
});

// captcha refresh code

function refreshCaptcha() {

    let icon = document.getElementById('refresh-icon');

    icon.classList.remove("rotate-once"); // reset animation
    void icon.offsetWidth; // trigger reflow
    icon.classList.add("rotate-once"); // re-apply animation

    document.getElementById("captcha-img").src = "authentication/captcha.php?" + Date.now();
}