<footer class="footer">
  <div class="container">
    <p>&copy; 2023-<?php echo date('Y'); ?> <a href="#">Gama</a></p>
    <p>Desenvolvido por <a >Isaque, Hiago e Hugo</a></p>
  </div>
</footer>

<style>
footer.footer {
    background-color: #1f1f1f;
    color: #d1d1d1;
    border-top: 1px solid #333;
    padding: 20px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

footer .container {
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
    color: #d1d1d1;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #00adb5;
    text-decoration: underline;
}

@media (max-width: 768px) {
    footer .container {
        flex-direction: column;
        align-items: flex-start;
    }
    footer p {
        margin-bottom: 8px;
    }
}
</style>
