const deleteButtons = document.querySelectorAll('form.element-deleter');

deleteButtons.forEach((button) => {
    button.addEventListener('submit', function(event) {
        event.preventDefault();
        const elementName = button.getAttribute('data-element-name');
        const confirmationPopUp = window.confirm(`Are you sure you want to delete ${elementName}?`);
        if (confirmationPopUp) this.submit();
    });
});