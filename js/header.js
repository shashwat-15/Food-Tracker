
window.addEventListener("load", function() {

    const example_form = document.forms.login_form;

    example_form.addEventListener("submit", function(event) {
        event.preventDefault();
        let a = document.getElementById("change_name");
        let em = example_form.email.value;
        a.innerHTML = em;

    });
});