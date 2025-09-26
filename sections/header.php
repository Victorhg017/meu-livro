<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Sopro do Vazio</title> 
    <meta name="description" content="Site oficial de O Sopro do Vazio, uma história de fantasia sombria com intriga, mistério e aventura.">
    
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/personagens.css">
    <link rel="stylesheet" href="/styles/chat.css">
    <link rel="stylesheet" href="/styles/ia.css"> <link rel="stylesheet" href="/styles/header.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=IM+Fell+DW+Pica:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
        }
        
:root {
    --cor-fundo-principal: #212529;
    --cor-fundo-secundario: #343a40;
    --cor-texto-principal: #f8f9fa;
    --cor-acento-dourado: #ffd700;
    --cor-separador: #6c757d;
    --cor-borda: #495057;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, var(--cor-fundo-principal) 0%, var(--cor-fundo-secundario) 50%, var(--cor-texto-principal) 100%);
    color: var(--cor-texto-principal);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Header */
        .header {
            background: var(--cor-fundo-principal);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid rgba(233, 69, 96, 0.3);
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
            text-shadow: 0 0 15px rgba(233, 69, 96, 0.6);
        }
        
        .nav-menu {
            display: flex;
            gap: 30px;
        }
        
        .nav-item {
            position: relative;
            cursor: pointer;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background: rgba(233, 69, 96, 0.1);
            color: var(--primary);
        }
        
        .nav-item.active {
            background: rgba(233, 69, 96, 0.2);
            color: var(--primary);
        }
        
        /* Sidebar de Capítulos */
        .sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100vh;
            background: var(--cor-fundo-principal);
            backdrop-filter: blur(15px);
            z-index: 2000;
            transition: left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            padding: 20px 20px 40px;
        }
        
        .sidebar.active {
            left: 0;
        }
        
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(233, 69, 96, 0.3);
        }
        
        .sidebar-title {
            font-size: 1.8rem;
            color: var(--primary);
        }
        
        .close-sidebar {
            background: none;
            border: none;
            color: var(--light);
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .close-sidebar:hover {
            transform: rotate(90deg);
            color: var(--primary);
        }
        
        .chapters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .chapter-card {
            background: linear-gradient(145deg, var(--secondary), var(--dark));
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(233, 69, 96, 0.2);
        }
        
        .chapter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border-color: var(--primary);
        }
        
        .chapter-image {
            height: 180px;
            background: linear-gradient(145deg, var(--secondary), var(--dark-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-style: italic;
            position: relative;
            overflow: hidden;
        }
        
        .chapter-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(233, 69, 96, 0.1), transparent);
            transform: translateX(-100%);
            animation: shine 3s infinite;
        }
        
        .chapter-content {
            padding: 20px;
        }
        
        .chapter-title {
            font-size: 1.3rem;
            color: var(--light);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .chapter-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .status-coming {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }
        
        .status-finalizing {
            background: rgba(0, 123, 255, 0.2);
            color: #007bff;
        }
        
        .status-ready {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
        
        /* Conteúdo Principal */
        .main-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 30px;
            text-shadow: 0 0 20px rgba(233, 69, 96, 0.6);
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from { text-shadow: 0 0 20px rgba(233, 69, 96, 0.6); }
            to { text-shadow: 0 0 30px rgba(233, 69, 96, 0.8), 0 0 40px rgba(233, 69, 96, 0.4); }
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Navegação de personagens */
        .nav-personagens { 
            display: flex; 
            justify-content: center; 
            gap: 15px; 
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .nav-btn {
            background: linear-gradient(145deg, var(--dark-secondary), var(--secondary));
            border: 2px solid rgba(233, 69, 96, 0.3);
            color: var(--light); 
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .nav-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(233, 69, 96, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .nav-btn:hover::before {
            left: 100%;
        }
        
        .nav-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.3);
            border-color: var(--primary);
        }
        
        .nav-btn.active {
            background: linear-gradient(145deg, var(--primary), #d32f2f);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
        }
        
        /* Carrossel de personagens */
        .personagem-content { 
            display: none;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        
        .personagem-content.active { 
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .personagem-nome {
            text-align: center; 
            margin-bottom: 25px; 
            color: var(--primary); 
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .carrossel-interno {
            background: linear-gradient(145deg, var(--dark-secondary), var(--secondary));
            border-radius: 20px;
            padding: 25px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(233, 69, 96, 0.2);
            overflow: hidden;
        }
        
        .carrossel-interno::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            animation: shimmer 3s infinite;
            background-size: 200% 100%;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .slides { 
            position: relative; 
            min-height: 280px;
            overflow: hidden;
        }
        
        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            align-items: center;
            pointer-events: none;
        }
        
        .slide.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }
        
        .slide-imagem {
            background: linear-gradient(145deg, var(--secondary), var(--dark-secondary));
            border-radius: 15px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-style: italic;
            border: 2px solid rgba(233, 69, 96, 0.3);
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .slide-imagem:hover {
            transform: scale(1.02);
            box-shadow: 0 0 30px rgba(233, 69, 96, 0.4);
        }
        
        .slide-texto {
            padding: 15px;
        }
        
        .slide-texto h3 { 
            color: var(--primary); 
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .slide-texto p { 
            font-size: 0.95rem; 
            line-height: 1.6;
            color: var(--gray);
        }
        
        .controles {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }
        
        .controles button {
            background: linear-gradient(145deg, var(--secondary), var(--dark-secondary));
            border: 2px solid rgba(233, 69, 96, 0.4);
            color: var(--light);
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .controles button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.3);
            border-color: var(--primary);
        }
        
        .indicadores {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        
        .indicador {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .indicador.active {
            background: var(--primary);
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(233, 69, 96, 0.5);
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .slide { 
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .slide-imagem {
                height: 150px;
                margin-bottom: 15px;
            }
            
            .nav-personagens {
                gap: 10px;
            }
            
            .nav-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .personagem-nome {
                font-size: 1.7rem;
            }
            
            .chapters-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-menu {
                gap: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .section-title {
                font-size: 2rem;
            }
            
            .personagem-nome {
                font-size: 1.5rem;
            }
            
            .controles button {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .nav-menu {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    <header class="header">
        <div class="nav-container">
            <a href="/index.php" class="logo">O Sopro do Vazio</a>
            <nav class="nav-menu">
                <div class="nav-item active" id="nav-capitulos">Capítulos</div>
                <a href="/index.php#personagens" class="nav-item" id="nav-personagens">Personagens</a>
                <a href="/index.php" class="nav-item" id="nav-home">Sobre o Autor</a>

            </nav>
        </div>
    </header>
    
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">Capítulos da Aventura</h2>
            <button class="close-sidebar" id="close-sidebar">&times;</button>
        </div>
        <div class="chapters-grid">
            <div class="chapter-card">
                <a href="/paginas/Capitulo1.html" class="chapter-link">
                    <div class="chapter-image">Imagem do Capítulo 1</div>
                    <div class="chapter-content">
                        <h3 class="chapter-title">O Início da Jornada</h3>
                        <span class="chapter-status status-ready">Pronto</span>
                    </div>
                </a>
            </div>
            <div class="chapter-card">
                <a href="/paginas/Capitulo2.html" class="chapter-link">
                    <div class="chapter-image">Imagem do Capítulo 2</div>
                    <div class="chapter-content">
                        <h3 class="chapter-title">A Floresta Encantada</h3>
                        <span class="chapter-status status-ready">Pronto</span>
                    </div>
                </a>
            </div>
            </div>
    </div>