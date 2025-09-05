document.addEventListener('DOMContentLoaded', function() {
    const formObjective = document.getElementById('formObjective');
    const orcamentoFields = document.getElementById('orcamentoFields');
    const contactForm = document.getElementById('contactForm');

    function toggleOrcamentoFields() {
        orcamentoFields.classList.toggle('hidden', formObjective.value !== 'orcamento');
    }

    formObjective.addEventListener('change', toggleOrcamentoFields);

    async function handleSubmit(event) {
        event.preventDefault();
        const form = event.target;
        const data = new FormData(form);

        // Adiciona o assunto dinâmico aos dados do formulário
        const objectiveText = formObjective.options[formObjective.selectedIndex].text;
        data.append('_subject', `${objectiveText} - Contato Site Insygro`);

        try {
            const response = await fetch(form.action, {
                method: form.method,
                body: data,
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                alert('Mensagem enviada com sucesso! Agradecemos o seu contato.');
                form.reset();
                grecaptcha.reset();
                toggleOrcamentoFields();
            } else {
                const responseData = await response.json();
                if (Object.hasOwn(responseData, 'errors')) {
                    alert(responseData["errors"].map(error => error["message"]).join(", "));
                } else {
                    alert('Ocorreu um erro ao enviar a mensagem. Tente novamente.');
                }
            }
        } catch (error) {
            alert('Ocorreu um erro ao enviar a mensagem. Verifique sua conexão e tente novamente.');
        }
    }

    contactForm.addEventListener('submit', handleSubmit);

    toggleOrcamentoFields();
});