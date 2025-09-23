<footer class="footer">
  <div class="footer-content">
    <p>&copy; 2023-<?php echo date('Y'); ?> <a href="#">Gama</a></p>
    <p>Desenvolvido por: <a >Isaque, Hiago e Hugo</a></p>
  </div>
</footer>

<style>

html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1; /* ocupa todo o espaço disponível */
}


footer.footer {
    background-color: #048a2cff;
    color: #030303ff;
    border-top: 1px solid #333;
    padding: 20px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
     width: 100%;      /* ocupa toda a largura */
    margin-top: auto;
}

footer .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

footer p {
    margin: 0;
    font-size: 15px;
}

footer a {
    color: #000000ff;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #00adb5;
    text-decoration: underline;
}

@media (max-width: 768px) {
    footer .footer-content {
        flex-direction: column;
        align-items: flex-start;
    }
    footer p {
        margin-bottom: 8px;
    }
}
</style>
