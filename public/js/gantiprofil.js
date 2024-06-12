window.onload = function() {
    // Validasi email
    document.getElementById('email').oninvalid = function(event) {
        event.target.setCustomValidity('Mohon isi email');
    };
    document.getElementById('email').oninput = function(event) {
        event.target.setCustomValidity('');
    };

    // Validasi password
    document.getElementById('username').oninvalid = function(event) {
        event.target.setCustomValidity('Mohon isi username');
    };
    document.getElementById('username').oninput = function(event) {
        event.target.setCustomValidity('');
    };

    // Validasi nomerhp
    document.getElementById('nomerhp').oninvalid = function(event) {
        event.target.setCustomValidity('Mohon isi nomer hp');
    };
    document.getElementById('nomerhp').oninput = function(event) {
        event.target.setCustomValidity('');
    };
};
