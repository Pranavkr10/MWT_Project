document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('form').addEventListener('submit', function(e){
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (name.length == 0){
            alert('Please enter your full name.');
            e.preventDefault();
            return;
        }

        if(password.length < 6){
            alert('Password must be at least 6 characters long');
            e.preventDefault();
            return;
        }

        if(password !== confirmPassword){
            alert('Passwords do not match!');
            e.preventDefault();
            return;
        }
    })
})
