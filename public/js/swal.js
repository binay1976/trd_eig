function showWelcome(username, redirectUrl) {
    Swal.fire({
        title: 'Welcome!',
        html: `
            <div style="
                font-size: 18px;
                margin-top: 10px;
                opacity: 0.85;
            ">
                Welcome back, <strong>${username}</strong>
            </div>
        `,
        icon: 'success',
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,

        background: 'rgba(167, 123, 4, 0.92)',
        color: '#ffffff',

        showClass: {
            popup: 'animate__animated animate__zoomIn'
        },

        hideClass: {
            popup: 'animate__animated animate__zoomOut'
        }
    }).then(() => {
        window.location.href = redirectUrl;
    });
}