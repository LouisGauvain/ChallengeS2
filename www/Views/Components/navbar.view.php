<nav class="navbar flex wrapped" id="menu">
    <div class="flex column no-gap align-start height-100 justify-start bg-color">
        <button class="large home dark">Accueil</button>
        <button class="large dashboard dark">Dashboard</button>
        <button class="large pages dark">Pages</button>
        <button class="large comments dark">Commentaires</button>
        <button class="large medias dark">Medias</button>
        <button class="large templates dark">Templates</button>
        <button class="large users dark">Utilisateurs</button>
        <button class="large settings dark">Settings</button>
        <button class="large seo dark">SEO</button>
        <button class="large menu dark mt-auto">Menu</button>
    </div>
</nav>
<script>
    const menu = document.querySelector('nav .menu');
    const navbar = document.querySelector('.navbar');

    console.log(menu);
    menu.addEventListener('click', () => {
        navbar.classList.toggle('wrapped');
    });
</script>