<?php
    $discord_url = "https://discord.com/api/oauth2/authorize?client_id=1040985204338204732&redirect_uri=http%3A%2F%2Flocalhost%2FTGE%2Flogin%2FloginDiscordProcess%2Fdiscord-login-process-oauth.php&response_type=code&scope=identify%20guilds";
    header("Location: $discord_url");
    exit();
    