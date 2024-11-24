{extends file="main.html"}

{block name=footer}Robert Krzykawski{/block}

{block name=content}

<section>
        <h3>Podaj dane do logowania</h3>
        <form method="post" action="{$conf->action_url}login">
                <div>
                        <div>
                            <input id="id_login" type="text" name="login" placeholder="Login"/>
                        </div>
                        <div>
                               <input id="id_pass" type="password" name="pass" placeholder="Hasło"/>
                        </div>
                        <div>
                                <ul class="actions">
                                        <input type="submit" value="Zaloguj"/>
                                </ul>
                        </div>
                </div>
        </form>
</section>

{include file='messages.tpl'}
{/block}