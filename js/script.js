document.addEventListener('DOMContentLoaded', function() {
    
    // --- Constantes Globais ---
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    const body = document.querySelector('body');

    // --- Funções do Menu ---
    // A função agora aceita um parâmetro para controlar a animação
    function openNav(animate = false) {
        if (!nav || !body || !burger) return;
        nav.classList.add('nav-active');
        body.classList.add('no-scroll');
        burger.classList.add('toggle');
        
        // Só executa a animação se 'animate' for verdadeiro
        if (animate) {
            navLinks.forEach((link, index) => {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
            });
        }
    }

    function closeNav() {
        if (!nav || !body || !burger) return;
        nav.classList.remove('nav-active');
        body.classList.remove('no-scroll');
        burger.classList.remove('toggle');
        // Reseta a animação para que possa ser executada da próxima vez
        navLinks.forEach(link => {
            link.style.animation = '';
        });
    }

    // --- Lógica Principal do Menu ---
    if (burger && nav) {
        // 1. Abrir/Fechar ao clicar no ícone
        burger.addEventListener('click', () => {
            if (nav.classList.contains('nav-active')) {
                closeNav();
            } else {
                // Chama openNav com animação
                openNav(true); 
            }
        });

        // 2. Fechar ao clicar fora do menu
        document.addEventListener('click', function(event) {
            const isNavActive = nav.classList.contains('nav-active');
            const isClickOutside = !nav.contains(event.target) && !burger.contains(event.target);
            if (isNavActive && isClickOutside) {
                closeNav();
            }
        });

        // 3. Sinalizar para manter o menu aberto na próxima página
        navLinks.forEach(item => {
            item.querySelector('a').addEventListener('click', function() {
                if (nav.classList.contains('nav-active')) {
                    sessionStorage.setItem('openMobileMenu', 'true');
                }
            });
        });

        // 4. Verificar o sinal ao carregar a página
        if (sessionStorage.getItem('openMobileMenu') === 'true') {
            // Chama openNav SEM animação
            openNav(false); 
            sessionStorage.removeItem('openMobileMenu');
        }
    }

    // --- Lógica para o Formulário de Contato (permanece igual) ---
    const form = document.getElementById('contact-form');
    const objetivoDuvida = document.getElementById('objetivo-duvida');
    const objetivoOrcamento = document.getElementById('objetivo-orcamento');
    const orcamentoFields = document.getElementById('orcamento-fields');
    const formSubject = document.getElementById('form-subject');
    const statusModal = document.getElementById('status-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const closeModalBtn = document.getElementById('close-modal-btn');

    function toggleOrcamentoFields() {
        if (objetivoOrcamento && objetivoOrcamento.checked) {
            orcamentoFields.classList.remove('hidden');
            if (formSubject) formSubject.value = "Contato do Site: Pedido de Orçamento";
        } else if (orcamentoFields) {
            orcamentoFields.classList.add('hidden');
            if (formSubject) formSubject.value = "Contato do Site: Dúvida";
        }
    }

    if (objetivoDuvida) objetivoDuvida.addEventListener('change', toggleOrcamentoFields);
    if (objetivoOrcamento) objetivoOrcamento.addEventListener('change', toggleOrcamentoFields);
    if (form) toggleOrcamentoFields();

    function showModal(title, message) {
        if(statusModal) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            statusModal.classList.remove('hidden');
        }
    }

    function hideModal() {
        if(statusModal) statusModal.classList.add('hidden');
    }

    if (closeModalBtn) closeModalBtn.addEventListener('click', hideModal);
    if (statusModal) statusModal.addEventListener('click', (event) => {
        if (event.target === statusModal) hideModal();
    });

    async function handleSubmit(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        
        try {
            const response = await fetch(event.target.action, {
                method: form.method,
                body: data,
                headers: { 'Accept': 'application/json' }
            });

            if (response.ok) {
                showModal("Sucesso!", "Sua mensagem foi enviada. Entraremos em contato em breve.");
                form.reset();
                if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
                toggleOrcamentoFields();
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