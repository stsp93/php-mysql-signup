$('form').on('submit', function (e) {
    const { username, password, rePassword, phone, email } = Object.fromEntries(new FormData(this));

    try {
        if (!validateLength(username)) {
            $('#username').addClass('border-danger');
        }else {
            $('#username').removeClass('border-danger');
        }

        if (!validateLength(password)) {
            $('#password').addClass('border-danger');
        }else {
            $('#password').removeClass('border-danger');
        }

        // Block guard for register submit
        if(rePassword === undefined || phone === undefined || email === undefined )  {
            if($('.border-danger').length > 0) {
                throw new Error('Invalid login format');
            }
            return;
        }

        if (!validateEmail(email)) {
            $('#email').addClass('border-danger');
        }else {
            $('#email').removeClass('border-danger');
        }

        if (!validatePhone(phone)) {
            $('#phone').addClass('border-danger');
        }else {
            $('#phone').removeClass('border-danger');
        }

        if(!rePassword || password !== rePassword) {
            $('#rePassword').addClass('border-danger');
        }else {
            $('#rePassword').removeClass('border-danger');
        }

        if($('.border-danger').length > 0) {
            throw new Error('Invalid register format');
        }
    } catch (err) {
        console.error(err);
        e.preventDefault();
    }
});

// Validation functions
function validateLength(input) {
    return input.length >= 3;
}

function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    if (phone === '') return true;
    const phoneRegex = /^\+[0-9]{1,3}[0-9]{4,14}$/;
    return phoneRegex.test(phone);
}