<footer class="footer">
  <div class="footer-content">
    <p>&copy; 2023-<?php echo date('Y'); ?> <a href="#">EcoWay</a></p>   

<div>
<button class="btn-instagram">
<img src="../img/instagram2.jpeg"/> 
</button>

<button class="btn-facebook">
<img src="https://img.icons8.com/color/16/000000/facebook-new.png"/> 
 
</button>
</div>

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
    background-color: #e5e8e6ff;
    color: #000000ff;
    border-top: 1px solid #ffffffff;
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

/* Botão instagram */
.btn-instagram {
  background-color: #ffffffff;
  color: #e1d9d9ff;
  border: 0px solid #ccc;
}
.btn-instagram:hover {
  background-color: #f2f2f2;
}

.btn-instagram img {
    width: 50px;   /* diminui a largura */
    height: 50px;  /* mantém proporcional */
    margin-right: 0px; /* espaço entre logo e texto */
    vertical-align: middle;
}

.btn-instagram img {
  border-radius: 50%; /* deixa redondo */
}


/* Botão Facebook */
.btn-facebook {
  background-color: #1877f2;
  color: #fff;
}
.btn-facebook:hover {
  background-color: #145dbf;
}

</style>
