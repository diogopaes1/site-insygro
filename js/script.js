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
                const errorMsg = responseData.errors ? responseData.errors.map(e => e.message).join(", ") : "Por favor, complete a verificação de segurança e tente novamente.";
                showModal("Verificação de Segurança", `${errorMsg}`);
            }
        } catch (error) {
            showModal("Erro de Conexão", "Não foi possível conectar ao servidor. Verifique sua internet e tente novamente.");
        }
    }

    if (form) form.addEventListener("submit", handleSubmit);

    // --- Formatação Automática do Telefone ---
    const phoneInput = document.getElementById('phone');
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            
            // Limita a 11 dígitos (DDD + 9 dígitos)
            if (value.length > 11) {
                value = value.slice(0, 11);
            }
            
            // Aplica a formatação
            if (value.length >= 3) {
                if (value.length <= 6) {
                    value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                } else {
                    value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
                }
            } else if (value.length >= 1) {
                value = `(${value}`;
            }
            
            e.target.value = value;
        });
        
        // Permite apenas números, backspace, delete e arrows
        phoneInput.addEventListener('keydown', function(e) {
            const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'];
            if (!allowedKeys.includes(e.key) && !/^\d$/.test(e.key)) {
                e.preventDefault();
            }
        });
    }

    // --- Validação da Política de Privacidade ---
    const privacyCheckbox = document.getElementById('privacy-consent');
    const submitButton = document.querySelector('button[type="submit"]');
    
    if (privacyCheckbox && submitButton) {
        function toggleSubmitButton() {
            submitButton.disabled = !privacyCheckbox.checked;
            submitButton.style.opacity = privacyCheckbox.checked ? '1' : '0.5';
            submitButton.style.cursor = privacyCheckbox.checked ? 'pointer' : 'not-allowed';
        }
        
        // Inicial
        toggleSubmitButton();
        
        // Listener
        privacyCheckbox.addEventListener('change', toggleSubmitButton);
    }

    // --- Contador de Caracteres para Textarea ---
    const messageTextarea = document.getElementById('message');
    if (messageTextarea) {
        const maxLength = 2000; // Limite de caracteres
        messageTextarea.setAttribute('maxlength', maxLength);
        
        // Criar elemento contador
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.textContent = `0/${maxLength} caracteres`;
        
        // Inserir contador após a textarea
        messageTextarea.parentNode.appendChild(counter);
        
        // Função para atualizar contador
        function updateCounter() {
            const currentLength = messageTextarea.value.length;
            counter.textContent = `${currentLength}/${maxLength} caracteres`;
            
            // Adicionar classe warning quando próximo do limite
            if (currentLength > maxLength * 0.9) {
                counter.classList.add('warning');
            } else {
                counter.classList.remove('warning');
            }
        }
        
        // Listeners para atualizar contador
        messageTextarea.addEventListener('input', updateCounter);
        messageTextarea.addEventListener('keyup', updateCounter);
    }
});