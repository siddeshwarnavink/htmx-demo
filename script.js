document.body.addEventListener('htmx:afterSwap', () => {
    const form = document.querySelector('form');

    if(form) {
        document.addEventListener('htmx:afterRequest', (event) => {
            if(event.detail.elt.tagName === "FORM" && event.detail.xhr.status === 400) {
                const errorData = JSON.parse(event.detail.xhr.response);

                for (const error of errorData) {
                    const errorMessageElement = document.querySelector(`form [name="${error.field}"] + .error-message`);

                    if (errorMessageElement)
                        errorMessageElement.textContent = error.message;
                }
            }
        });
    }
});
