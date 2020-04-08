<script>
jQuery('.ajax-file-upload')[0].childNodes[0].nodeValue = "Joindre un document";
</script>

<?php //OR ?>

<style>
[type=file]#user_cover,
[type=file]#user_avatar {
    visibility:hidden;
}
[type=file]#user_cover::before,
[type=file]#user_avatar::before {
    content: 'Choisir le fichier';
    position: relative;
    display: inline-block;
    background: #E5E5E5;
    padding: 2px 10px;
    color: #000;
    opacity: 1;
    border: 1px solid #aaa;
    font-size: 13px;
    visibility:visible;
}
[type=file]#user_cover::after,
[type=file]#user_avatar::after {
    content: 'Aucun fichier choisi';
    position: relative;
    display: inline-block;
    margin-left: -80px;
    visibility:visible;
}
</style>