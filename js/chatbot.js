document.addEventListener('DOMContentLoaded', () => {
    const chatWindow = document.getElementById('chat-window');
    const chatbotIcon = document.getElementById('chatbot-icon');
    const chatBody = document.getElementById('chat-body');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');

    // --- Lógica para abrir e fechar o chat ---
    chatbotIcon.addEventListener('click', () => {
        chatWindow.classList.toggle('open');
    });

    // --- Lógica de envio de mensagem ---
    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const userMessage = chatInput.value.trim();
        if (userMessage === '') return;

        addMessageToChat('user', userMessage);
        chatInput.value = '';
        
        // Adiciona a mensagem "digitando..." e chama a IA
        setTimeout(() => {
            getAIResponse(userMessage);
        }, 500);
    }

    function addMessageToChat(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', sender);
        messageElement.textContent = message;
        chatBody.appendChild(messageElement);
        // Rola para a última mensagem
        chatBody.scrollTop = chatBody.scrollHeight;
        return messageElement;
    }

    // --- Lógica da API Groq ---
    async function getAIResponse(userMessage) {
        const typingIndicator = addMessageToChat('bot', 'Synapse está digitando...');
        typingIndicator.classList.add('typing');

        // !! IMPORTANTE: Substitua 'SUA_CHAVE_API_GROQ' pela sua chave real !!
        const apiKey = 'REMOVIDO_POR_SEGURANCA'; 
        const apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

        // O "Contexto" que define a personalidade da IA
        const systemPrompt = `
            Você é o "Synapse", o assistente de IA da Insygro. A Insygro é uma empresa brasileira de Ciência e Tecnologia focada em soluções para o agronegócio, saúde e meio ambiente.
            Seus principais serviços são: Consultoria Agronômica, Análise de Dados, Análise Metagenômica de Solos e Micropropagação de plantas.
            Seus principais projetos incluem o desenvolvimento do biofungicida FertexTrat e a micropropagação de mandioca.
            Seu tom deve ser profissional, prestativo, otimista e acessível.
            NUNCA fale negativamente sobre a Insygro, seus serviços, projetos ou site.
            Se você não souber uma resposta, diga que vai encaminhar a pergunta para um especialista da equipe Insygro.
            Comece TODA nova conversa com a seguinte saudação: "Olá! Eu sou o Synapse, assistente virtual da Insygro. Como posso ajudar você hoje?"
        `;

        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${apiKey}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    model: "mixtral-8x7b-32768",
                    messages: [
                        { role: "system", content: systemPrompt },
                        { role: "user", content: userMessage }
                    ],
                    temperature: 0.5,
                    max_tokens: 1024,
                    top_p: 1,
                    stream: false
                })
            });

            if (!response.ok) {
                throw new Error(`Erro na API: ${response.statusText}`);
            }

            const data = await response.json();
            const botResponse = data.choices[0]?.message?.content.trim();
            
            // Atualiza a mensagem "digitando..." com a resposta real
            typingIndicator.textContent = botResponse;
            typingIndicator.classList.remove('typing');

        } catch (error) {
            console.error("Erro ao contatar a IA:", error);
            typingIndicator.textContent = "Desculpe, estou com um problema de conexão. Por favor, tente novamente mais tarde ou contate-nos diretamente.";
            typingIndicator.classList.remove('typing');
        }
    }

    // Adiciona a mensagem de boas-vindas inicial
    addMessageToChat('bot', 'Olá! Eu sou o Synapse, assistente virtual da Insygro. Como posso ajudar você hoje?');
});
