<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Entre em contato com a Insygro. Estamos prontos para discutir seu projeto e encontrar a melhor solução em ciência de dados e biotecnologia para o seu negócio.">
    <title>Contato - Insygro</title>
    <link rel="icon" href="Image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.html"><img src="Image/Logo_Insygro.jpg" alt="Logo Insygro"></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="servicos.html">Serviços</a></li>
                    <li><a href="projetos.html">Projetos</a></li>
                    <li><a href="sobre.html">Sobre</a></li>
                    <li><a href="contato.php" class="active">Contato</a></li>
                </ul>
                <div class="burger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="page-title contact-title">
            <div class="container">
                <h1>FALE CONOSCO</h1>
                <p>Tem uma pergunta ou quer iniciar um projeto? Preencha o formulário abaixo.</p>
            </div>
        </section>

        <section class="contact-form-section">
            <div class="container">
                <form id="contact-form" action="https://formspree.io/f/<?php echo getenv('FORMSPREE_KEY'); ?>" method="post">
                    
                    <!-- O Formspree usa _next para redirecionar após o envio. Apontei para uma futura página de "obrigado". -->
                    <input type="hidden" name="_next" value="https://insygro.com.br/obrigado.html"> 
                    
                    <div class="form-fields-container"> <!-- Início da nova caixa -->
                        <div class="form-group objective-group">
                        <label>Objetivo do Contato:</label>
                        <div class="radio-group">
                            <input type="radio" id="objetivo-duvida" name="objetivo" value="Dúvida" checked>
                            <label for="objetivo-duvida">Dúvidas</label>
                            <input type="radio" id="objetivo-orcamento" name="objetivo" value="Orçamento">
                            <label for="objetivo-orcamento">Orçamento</label>
                        </div>
                    </div>

                    <!-- Campos que aparecem apenas para Orçamento -->
                    <div id="orcamento-fields" class="hidden">
                        <div class="form-group">
                            <label for="servico">Selecione o Serviço de Interesse:</label>
                            <select id="servico" name="servico_interesse">
                                <option value="Análise de Dados e Consultoria Estatística">Análise de Dados e Consultoria Estatística</option>
                                <option value="Bioinformática e Análise Metagenômica">Bioinformática e Análise Metagenômica</option>
                                <option value="Consultoria Agronômica Avançada">Consultoria Agronômica Avançada</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="assunto">Assunto</label>
                        <input type="text" id="assunto" name="assunto" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profissao">Profissão</label>
                        <input type="text" id="profissao" name="profissao" required>
                    </div>

                    <div class="form-row-three">
                        <div class="form-group phone-input">
                            <label for="phone">Telefone</label>
                            <input type="tel" id="phone" name="phone" placeholder="(99) 99999-9999" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select id="state" name="state" required>
                                <option value="">Selecione</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                </div> <!-- Fim da nova caixa -->

                    <!-- Checkboxes de Política de Privacidade -->
                    <div class="privacy-checkbox-group">
                        <label>
                            <input type="checkbox" id="privacy-consent" name="privacy_consent" required>
                            Concordo com a política de privacidade da empresa
                        </label>
                        <div class="privacy-terms">
                            Concordo em receber comunicações e declaro ter lido a 
                            <a href="politica-privacidade.html">[Política de Privacidade]</a>
                        </div>
                    </div>

                    <!-- Campo oculto para definir o assunto do e-mail automaticamente -->
                    <input type="hidden" id="form-subject" name="_subject" value="Contato do Site: Dúvida">

                    <div class="g-recaptcha" data-sitekey="6Lfs278rAAAAAKsk4xHU7TYyQFJXY7P2N7MvKNEV"></div>

                    <button type="submit" class="cta-button">Enviar Mensagem</button>
                </form>
            </div>
        </section>
    </main>

    <!-- HTML para o Modal de Sucesso/Erro -->
    <div id="status-modal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 id="modal-title"></h3>
            <p id="modal-message"></p>
            <button id="close-modal-btn" class="cta-button">Fechar</button>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Insygro Ciência e Tecnologia. Todos os direitos reservados.</p>
            <p class="footer-address">Rua São Miguel, 211, Boa Vista – Garanhuns, PE - CEP: 55292-640</p>
            <p class="footer-cnpj">CNPJ: 50.983.508/0001-25</p>
        </div>
    </footer>

    <!-- Re-adicionando o script do reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/script.js"></script>
    <script src="js/animations.js"></script>
</body>
</html>
