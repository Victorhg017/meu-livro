<?php include 'sections/header.php'; ?>

    <main class="conteudo">
        <section id="o-livro" class="secao-livro">
            <div class="banner-hero">
                <h2>Bem-vindo, Aventureiro.</h2>
                <a href="/paginas/explorar.html" class="btn-explorar">Crie seu Mundo</a>
            </div>
            <div id="sinopse" class="sinopse">
                <div class="capa">
                    <img src="/img/Livro.jpeg" alt="Capa do Livro">
                </div>
                <div class="texto-sinopse">
                    <h3>Introdução</h3>
                    <p>Durante séculos, o Reino de Auren viveu em paz. Um equilíbrio delicado entre reis, clérigos e povos de todas as raças sustentava uma estabilidade rara — não perfeita, mas funcional. A fé unia as vilas, e a luz da igreja era, para muitos, a última chama contra a escuridão do mundo antigo. Mas então o céu caiu.</p>
                    <p>Um meteoro — colossal, silencioso e inevitável — rasgou os céus e devastou uma vila inteira ao norte, apagando-a do mapa como se nunca tivesse existido. A poeira subiu por dias, e o impacto abriu uma cratera tão profunda que ninguém via o fundo. A igreja foi a primeira a enviar uma expedição. Clérigos, cavaleiros e estudiosos foram despachados sob o pretexto de investigar e proteger.</p>
                    <p>Foi quando tudo mudou. O silêncio se instalou. Nenhum relatório retornou. Em seu lugar, surgiram boatos. Pessoas começaram a desaparecer — algumas próximas ao local, outras em regiões distantes. A Igreja deixou de prestar contas. Os nobres eclesiásticos começaram a mudar: mais frios, mais fechados… menos humanos. Versões oficiais negavam qualquer risco. Chamavam de “evento controlado”, “anomalia estudada”, “obra divina”. Mas nas ruas, nas tavernas e entre os becos, o nome que começou a circular foi outro: Vazio. E onde há vazio… algo sempre tenta preenchê-lo.</p>
                </div>
            </div>
        </section>
        
        <?php 
            // Inclui o chat e o contexto da história.
            // Agora não precisamos mais duplicar esse código!
            include 'sections/chat.php'; 
        ?>

        <?php include 'sections/personagens.php'; ?>

        </main>

<?php include 'sections/footer.php'; ?>