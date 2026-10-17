<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Larnex · Pitch</title>
  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: #f8fafc;
      color: #0a0b0d;
      scroll-behavior: smooth;
    }
    /* Cada slide ocupa no mínimo 100vh, com padding vertical generoso */
    .slide {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4rem 2rem;
      background: #ffffff;
      border-bottom: 1px solid #eef0f3;
      scroll-snap-align: start;
    }
    .slide:nth-child(odd) { background: #fafbfc; }
    .slide-inner {
      max-width: 1100px;
      width: 100%;
      margin: 0 auto;
    }
    /* Títulos e textos */
    .badge {
      display: inline-block;
      background: #eef0f3;
      color: #0a0b0d;
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 0.3rem 0.9rem;
      border-radius: 100px;
      margin-bottom: 1.2rem;
    }
    h1 {
      font-size: clamp(2.4rem, 8vw, 4.2rem);
      font-weight: 600;
      line-height: 1.1;
      letter-spacing: -0.02em;
      color: #0a0b0d;
      margin-bottom: 1rem;
    }
    h1 .highlight { color: #0052ff; }
    h2 {
      font-size: clamp(1.8rem, 5vw, 2.8rem);
      font-weight: 500;
      letter-spacing: -0.01em;
      margin-bottom: 0.8rem;
    }
    .sub {
      font-size: 1.2rem;
      color: #5b616e;
      max-width: 640px;
      line-height: 1.6;
      margin-bottom: 1.8rem;
    }
    .sub strong { color: #0a0b0d; font-weight: 600; }
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-top: 1.5rem;
    }
    .card-dor {
      background: #f7f7f7;
      padding: 1.5rem 2rem;
      border-radius: 20px;
      border-left: 4px solid #0052ff;
      font-style: italic;
      color: #1e293b;
      font-weight: 500;
    }
    .card-dor i { color: #0052ff; margin-right: 0.5rem; }
    .list-check {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
    }
    .list-check li {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      font-size: 1.05rem;
      padding: 0.4rem 0;
      color: #1e293b;
    }
    .list-check li i { color: #0052ff; width: 1.4rem; }
    .pricing-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1.5rem;
      margin: 2rem 0;
    }
    .pricing-card {
      background: #ffffff;
      border: 1px solid #eef0f3;
      border-radius: 24px;
      padding: 1.8rem 1.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.02);
      transition: 0.2s;
    }
    .pricing-card.featured {
      border-color: #0052ff;
      background: #f5f9ff;
    }
    .pricing-card .plan { font-weight: 600; font-size: 1.2rem; }
    .pricing-card .price { font-size: 1.8rem; font-weight: 700; margin: 0.5rem 0; }
    .pricing-card .price small { font-size: 0.9rem; font-weight: 400; color: #5b616e; }
    .pricing-card ul { list-style: none; padding: 0; margin: 1rem 0; }
    .pricing-card ul li { padding: 0.25rem 0; font-size: 0.95rem; display: flex; gap: 0.5rem; align-items: center; }
    .pricing-card ul li i { color: #0052ff; width: 1.2rem; }
    .btn-primary {
      display: inline-block;
      background: #0052ff;
      color: white;
      font-weight: 600;
      padding: 0.8rem 2.2rem;
      border-radius: 100px;
      text-decoration: none;
      transition: 0.2s;
      border: none;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,82,255,0.15);
    }
    .btn-primary:hover { background: #003ecc; transform: scale(1.01); }
    .btn-outline {
      background: transparent;
      border: 1px solid #dee1e6;
      color: #0a0b0d;
      padding: 0.8rem 2.2rem;
      border-radius: 100px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
      display: inline-block;
    }
    .btn-outline:hover { background: #f1f3f5; }
    .demo-placeholder {
      background: #0a0b0d;
      border-radius: 28px;
      padding: 2rem 1.5rem 1.5rem;
      color: white;
      margin-top: 1.5rem;
      box-shadow: 0 20px 40px -12px rgba(0,0,0,0.25);
    }
    .demo-placeholder .mockup-browser {
      background: #1e1f23;
      border-radius: 16px;
      padding: 1rem;
    }
    .demo-placeholder .mockup-browser .dots { display: flex; gap: 6px; margin-bottom: 0.8rem; }
    .demo-placeholder .mockup-browser .dots span { width: 10px; height: 10px; border-radius: 50%; background: #3a3c42; }
    .demo-placeholder .mockup-browser .dots span:nth-child(1) { background: #ed6a5e; }
    .demo-placeholder .mockup-browser .dots span:nth-child(2) { background: #f5bd4f; }
    .demo-placeholder .mockup-browser .dots span:nth-child(3) { background: #61c454; }
    .demo-row {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: space-between;
      align-items: center;
    }
    .demo-row .card-preview {
      background: #2a2c32;
      border-radius: 16px;
      padding: 1rem;
      flex: 1 1 150px;
      text-align: center;
    }
    .demo-row .card-preview i { font-size: 2rem; color: #0052ff; }
    .demo-row .card-preview p { margin-top: 0.3rem; font-size: 0.8rem; color: #a8acb3; }
    .cta-big {
      background: #0a0b0d;
      color: white;
      padding: 2.5rem;
      border-radius: 32px;
      margin-top: 2rem;
      text-align: center;
    }
    .cta-big h2 { color: white; }
    .cta-big .sub { color: #a8acb3; }
    .cta-big .btn-primary { background: #0052ff; box-shadow: 0 8px 20px rgba(0,82,255,0.3); }
    /* Responsivo */
    @media (max-width: 768px) {
      .grid-2 { grid-template-columns: 1fr; }
      .slide { padding: 3rem 1.2rem; }
      .pricing-grid { grid-template-columns: 1fr; }
    }
    /* Navegação inferior (opcional) */
    .nav-dots {
      position: fixed;
      right: 1.5rem;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      z-index: 10;
    }
    .nav-dots a {
      display: block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #dee1e6;
      transition: 0.3s;
      border: 2px solid transparent;
    }
    .nav-dots a.active { background: #0052ff; border-color: #0052ff; }
    .nav-dots a:hover { background: #0052ff; opacity: 0.7; }
    /* Timer opcional */
    .timer-badge {
      position: fixed;
      bottom: 1.5rem;
      left: 1.5rem;
      background: rgba(10,11,13,0.85);
      color: white;
      padding: 0.5rem 1.2rem;
      border-radius: 100px;
      font-size: 0.9rem;
      font-weight: 500;
      backdrop-filter: blur(4px);
      z-index: 20;
      letter-spacing: 0.5px;
    }
    .timer-badge i { margin-right: 0.4rem; }
  </style>
</head>
<body>

  <!-- Navegação por dots -->
  <div class="nav-dots" id="navDots"></div>

  <!-- Timer -->
  <div class="timer-badge" id="timer">
    <i class="fa-solid fa-clock"></i> <span id="timerDisplay">2:00</span>
  </div>

  <!-- ===== SLIDE 1 – PROBLEMA ===== -->
  <section class="slide" id="slide1">
    <div class="slide-inner">
      <span class="badge"><i class="fa-solid fa-circle-exclamation"></i> Problema</span>
      <h1>Corretores presos ao <span class="highlight">passado digital</span></h1>
      <p class="sub">
        Milhares de corretores no Brasil não têm uma presença digital profissional que gere leads.
      </p>
      <div class="grid-2">
        <div>
          <ul class="list-check">
            <li><i class="fa-solid fa-circle-check"></i> <strong>500 mil</strong> corretores ativos (CRECI)</li>
            <li><i class="fa-solid fa-circle-check"></i> Menos de <strong>30%</strong> têm site profissional</li>
            <li><i class="fa-solid fa-circle-check"></i> Sites WordPress: caros, lentos, difíceis de atualizar</li>
          </ul>
        </div>
        <div class="card-dor">
          <i class="fa-solid fa-quote-left"></i> “Meu site não gera leads e dependo de agência para atualizar qualquer coisa.”
          <div style="margin-top: 0.8rem; font-style: normal; font-weight: 400; color: #5b616e;">— Corretor de imóveis</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SLIDE 2 – SOLUÇÃO ===== -->
  <section class="slide" id="slide2">
    <div class="slide-inner">
      <span class="badge"><i class="fa-solid fa-lightbulb"></i> Solução</span>
      <h1>Larnex – a vitrine digital que <span class="highlight">gera leads</span></h1>
      <p class="sub">
        O corretor cadastra imóveis em minutos, e o sistema gera uma página profissional com carrossel, filtros e integração nativa com WhatsApp.
      </p>
      <div style="display: flex; flex-wrap: wrap; gap: 2rem; margin: 1.5rem 0;">
        <div style="flex:1; min-width:200px;">
          <h3 style="font-weight:600; font-size:1.1rem;"><i class="fa-solid fa-circle-check" style="color:#0052ff;"></i> Autonomia total</h3>
          <p style="color:#5b616e;">Sem agência, sem dependência. Atualize seus imóveis a qualquer momento.</p>
        </div>
        <div style="flex:1; min-width:200px;">
          <h3 style="font-weight:600; font-size:1.1rem;"><i class="fa-brands fa-whatsapp" style="color:#25D366;"></i> Leads via WhatsApp</h3>
          <p style="color:#5b616e;">Cada lead chega como notificação em tempo real no WhatsApp do corretor.</p>
        </div>
        <div style="flex:1; min-width:200px;">
          <h3 style="font-weight:600; font-size:1.1rem;"><i class="fa-solid fa-rocket" style="color:#0052ff;"></i> Design otimizado</h3>
          <p style="color:#5b616e;">Foco em conversão, mobile-first e pronto para SEO.</p>
        </div>
      </div>
      <div style="background:#f7f7f7; padding:1.2rem 1.8rem; border-radius:100px; display:inline-block; font-weight:500;">
        <i class="fa-solid fa-arrow-right" style="color:#0052ff;"></i> De Linktree a um site profissional em minutos.
      </div>
    </div>
  </section>

  <!-- ===== SLIDE 3 – PRODUTO (DEMO) ===== -->
  <section class="slide" id="slide3">
    <div class="slide-inner">
      <span class="badge"><i class="fa-solid fa-laptop"></i> Demonstração</span>
      <h2>Veja como é <span class="highlight">simples</span></h2>
      <p class="sub">Da criação à captura de leads em menos de 5 minutos.</p>

      <!-- Mockup interativo / placeholder do sistema -->
      <div class="demo-placeholder">
        <div class="mockup-browser">
          <div class="dots"><span></span><span></span><span></span></div>
          <div style="display:flex; flex-direction: column; gap: 0.8rem;">
            <div style="display:flex; gap:0.8rem; flex-wrap:wrap;">
              <input type="text" placeholder="Título do imóvel" style="flex:2; padding:0.6rem 1rem; border-radius:100px; border:none; background:#3a3c42; color:white; min-width:140px;">
              <input type="text" placeholder="Preço" style="flex:1; padding:0.6rem 1rem; border-radius:100px; border:none; background:#3a3c42; color:white; min-width:100px;">
              <button class="btn-primary" style="padding:0.5rem 1.8rem; font-size:0.9rem;">Publicar</button>
            </div>
            <div class="demo-row">
              <div class="card-preview"><i class="fa-solid fa-image"></i><p>Vitrine</p></div>
              <div class="card-preview"><i class="fa-solid fa-sliders"></i><p>Filtros</p></div>
              <div class="card-preview"><i class="fa-brands fa-whatsapp" style="color:#25D366;"></i><p>Lead via WhatsApp</p></div>
              <div class="card-preview"><i class="fa-solid fa-chart-simple"></i><p>Dashboard</p></div>
            </div>
            <div style="background:#2a2c32; border-radius:16px; padding:0.8rem 1.2rem; display:flex; justify-content:space-between; align-items:center;">
              <span style="color:#a8acb3;"><i class="fa-solid fa-circle-check" style="color:#61c454;"></i> Lead recebido: Maria Silva – (11) 99999-9999</span>
              <span style="color:#61c454; font-weight:600;">Novo</span>
            </div>
          </div>
        </div>
        <p style="font-size:0.8rem; color:#a8acb3; margin-top:0.5rem; text-align:right;">
          <i class="fa-solid fa-eye"></i> Demonstração ao vivo durante o pitch
        </p>
      </div>
    </div>
  </section>

  <!-- ===== SLIDE 4 – MODELO DE NEGÓCIOS ===== -->
  <section class="slide" id="slide4">
    <div class="slide-inner">
      <span class="badge"><i class="fa-solid fa-coins"></i> Modelo de negócios</span>
      <h2>Planos acessíveis para <span class="highlight">cada perfil</span></h2>
      <div class="pricing-grid">
        <div class="pricing-card">
          <div class="plan">Free</div>
          <div class="price">R$ 0</div>
          <ul>
            <li><i class="fa-solid fa-check"></i> 1 imóvel</li>
            <li><i class="fa-solid fa-check"></i> Marca Larnex</li>
            <li><i class="fa-solid fa-xmark" style="color:#cf202f;"></i> Sem IA</li>
            <li><i class="fa-solid fa-xmark" style="color:#cf202f;"></i> Sem WhatsApp</li>
          </ul>
        </div>
        <div class="pricing-card featured">
          <div class="plan">Pro <span style="font-size:0.7rem; background:#0052ff; color:white; padding:0.1rem 0.6rem; border-radius:100px; margin-left:0.3rem;">Mais popular</span></div>
          <div class="price">R$ 69 <small>/mês</small></div>
          <ul>
            <li><i class="fa-solid fa-check"></i> 10 imóveis</li>
            <li><i class="fa-solid fa-check"></i> IA básica</li>
            <li><i class="fa-solid fa-check"></i> WhatsApp integrado</li>
            <li><i class="fa-solid fa-check"></i> Domínio próprio: <strong>+ R$ 199</strong> (setup)</li>
          </ul>
        </div>
        <div class="pricing-card">
          <div class="plan">Black</div>
          <div class="price">R$ 149 <small>/mês</small></div>
          <ul>
            <li><i class="fa-solid fa-check"></i> Imóveis <strong>ilimitados</strong></li>
            <li><i class="fa-solid fa-check"></i> IA avançada</li>
            <li><i class="fa-solid fa-check"></i> Suporte prioritário</li>
            <li><i class="fa-solid fa-check"></i> <strong>Domínio próprio incluso</strong></li>
          </ul>
        </div>
      </div>
      <div style="background:#f7f7f7; padding:1.2rem 1.8rem; border-radius:20px; display:flex; flex-wrap:wrap; gap:1.5rem; align-items:center; justify-content:space-between;">
        <div>
          <span style="font-weight:600;"><i class="fa-solid fa-gear"></i> Setup de domínio</span>
          <span style="color:#5b616e; margin-left:0.5rem;">Configuração técnica pela equipe – R$ 199 (taxa única)</span>
        </div>
        <div>
          <span style="font-weight:600;"><i class="fa-solid fa-crown"></i> White Label</span>
          <span style="color:#5b616e; margin-left:0.5rem;">Imobiliárias com sua própria marca – R$ 500/mês</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SLIDE 5 – TRAÇÃO E CTA ===== -->
  <section class="slide" id="slide5">
    <div class="slide-inner">
      <span class="badge"><i class="fa-solid fa-rocket"></i> Tração</span>
      <div class="cta-big">
        <h2 style="font-size:clamp(2rem,6vw,3.4rem);">Vamos construir o futuro <span style="color:#0052ff;">juntos</span></h2>
        <p class="sub" style="margin:1rem auto; max-width:600px;">
          O mercado imobiliário digital cresce <strong style="color:white;">40% ao ano</strong> no Brasil.
        </p>
        <div style="display:flex; flex-wrap:wrap; gap:1.5rem; justify-content:center; margin:1.5rem 0;">
          <div><i class="fa-solid fa-circle-check" style="color:#0052ff;"></i> Dono de imobiliária validou a ideia</div>
          <div><i class="fa-solid fa-circle-check" style="color:#0052ff;"></i> Protótipo funcional com usuários reais</div>
          <div><i class="fa-solid fa-circle-check" style="color:#0052ff;"></i> Potencial: 500 mil corretores</div>
        </div>
        <div style="margin-top:1.5rem;">
          <span style="display:inline-block; background:#0052ff; color:white; padding:0.8rem 2.5rem; border-radius:100px; font-weight:600;">
            Queremos transformar a presença digital de milhares de corretores.
          </span>
          <p style="margin-top:1rem; color:#a8acb3; font-size:0.9rem;">
            <i class="fa-solid fa-envelope"></i> supernova@institutoidf.org
          </p>
        </div>
      </div>
    </div>
  </section>

  <script>
    // Dots de navegação
    document.addEventListener('DOMContentLoaded', function() {
      const slides = document.querySelectorAll('.slide');
      const navDots = document.getElementById('navDots');

      slides.forEach((_, index) => {
        const dot = document.createElement('a');
        dot.href = `#slide${index+1}`;
        if (index === 0) dot.classList.add('active');
        navDots.appendChild(dot);
      });

      // Atualiza dot ativo ao scroll
      const dots = navDots.querySelectorAll('a');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = entry.target.id;
            const index = parseInt(id.replace('slide', '')) - 1;
            dots.forEach(d => d.classList.remove('active'));
            if (dots[index]) dots[index].classList.add('active');
          }
        });
      }, { threshold: 0.6 });

      slides.forEach(s => observer.observe(s));

      // Timer de 2 minutos (cronômetro regressivo)
      let seconds = 120;
      const timerDisplay = document.getElementById('timerDisplay');
      const timerInterval = setInterval(() => {
        seconds--;
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        timerDisplay.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
        if (seconds <= 0) {
          clearInterval(timerInterval);
          timerDisplay.textContent = '⏰ Tempo!';
        }
      }, 1000);

      // Scroll suave para os dots
      dots.forEach(dot => {
        dot.addEventListener('click', (e) => {
          e.preventDefault();
          const target = document.querySelector(dot.getAttribute('href'));
          if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
      });
    });
  </script>

</body>
</html>