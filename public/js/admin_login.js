window.togglePassword = function () {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    const isHidden = passwordInput.type === 'password';
    passwordInput.type = isHidden ? 'text' : 'password';

    eyeOpen.style.display = isHidden ? 'none' : 'inline';
    eyeClosed.style.display = isHidden ? 'inline' : 'none';
};
