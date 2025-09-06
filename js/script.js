document.addEventListener('DOMContentLoaded', function() {
    
    // --- Lógica para o Menu Hambúrguer ---
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    const body = document.querySelector('body');

    if (burger && nav) {
        burger.addEventListener('click', () => {
            // Mostra/Esconde o menu
            nav.classList.toggle('nav-active');
            
            // Trava/Destrava a rolagem da página
            body.classList.toggle('no-scroll');

            // Anima os links aparecendo
            navLinks.forEach((link, index) => {
                if (link.style.animation) {
                    link.style.animation = '';
                } else {
                    link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
                }
            });

            // Anima o ícone virando um "X"
            burger.classList.toggle('toggle');
        });
    }

    // --- Lógica para o Formulário de Contato ---
    const form = document.getElementById('contact-form');
    const objetivoDuvida = document.getElementById('objetivo-duvida');
    const objetivoOrcamento = document.getElementById('objetivo-orcamento');
    const orcamentoFields = document.getElementById('orcamento-fields');
    const formSubject = document.getElementById('form-subject');
    
    // Elementos do Modal
    const statusModal = document.getElementById('status-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const closeModalBtn = document.getElementById('close-modal-btn');

    // Função para mostrar/esconder campos de orçamento E definir o assunto
    function toggleOrcamentoFields() {
        if (objetivoOrcamento && objetivoOrcamento.checked) {
            orcamentoFields.classList.remove('hidden');
            if (formSubject) formSubject.value = "Contato do Site: Pedido de Orçamento"; // Define o assunto para Orçamento
        } else if (orcamentoFields) {
            orcamentoFields.classList.add('hidden');
            if (formSubject) formSubject.value = "Contato do Site: Dúvida"; // Define o assunto para Dúvida
        }
    }

    if (objetivoDuvida) objetivoDuvida.addEventListener('change', toggleOrcamentoFields);
    if (objetivoOrcamento) objetivoOrcamento.addEventListener('change', toggleOrcamentoFields);
    if (form) toggleOrcamentoFields(); // Verifica o estado inicial

    // Função para mostrar o modal
    function showModal(title, message) {
        if(statusModal) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            statusModal.classList.remove('hidden');
        }
    }

    // Função para esconder o modal
    function hideModal() {
        if(statusModal) statusModal.classList.add('hidden');
    }

    if (closeModalBtn) closeModalBtn.addEventListener('click', hideModal);
    if (statusModal) statusModal.addEventListener('click', (event) => {
        if (event.target === statusModal) hideModal();
    });

    // Lógica de envio do formulário com AJAX
    async function handleSubmit(event) {
        event.preventDefault(); // Impede o redirecionamento padrão
        const data = new FormData(event.target);
        
        try {
            const response = await fetch(event.target.action, {
                method: form.method,
                body: data,
                headers: { 'Accept': 'application/json' }
            });

            if (response.ok) {
                showModal("Sucesso!", "Sua mensagem foi enviada. Entraremos em contato em breve.");
                form.reset(); // Limpa o formulário
                if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
                toggleOrcamentoFields(); // Garante que os campos de orçamento voltem ao estado inicial
            } else {
                const responseData = await response.json();
                const errorMsg = responseData.errors ? responseData.errors.map(e => e.message).join(", ") : "Tente novamente mais tarde.";
                showModal("Erro no Envio", `Houve um problema: ${errorMsg}`);
            }
        } catch (error) {
            showModal("Erro de Conexão", "Não foi possível conectar ao servidor. Verifique sua internet e tente novamente.");
        }
    }

    if (form) form.addEventListener("submit", handleSubmit);
});