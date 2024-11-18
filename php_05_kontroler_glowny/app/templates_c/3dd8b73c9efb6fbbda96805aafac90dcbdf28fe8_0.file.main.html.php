<?php
/* Smarty version 4.5.4, created on 2024-11-17 10:48:49
  from 'C:\xampp\htdocs\php_05_kontroler_glowny\templates\main.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6739bc0178c709_18437618',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3dd8b73c9efb6fbbda96805aafac90dcbdf28fe8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_05_kontroler_glowny\\templates\\main.html',
      1 => 1730919352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6739bc0178c709_18437618 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['page_description']->value ?? null)===null||$tmp==='' ? 'Opis domyślny' ?? null : $tmp);?>
">
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['page_title']->value ?? null)===null||$tmp==='' ? 'Tytuł domyślny' ?? null : $tmp);?>
</title>

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/css/style.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/js/softscroll.js"><?php echo '</script'; ?>
>
</head>
<body>

<div id="app_top" class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href=""><?php echo (($tmp = $_smarty_tpl->tpl_vars['page_title']->value ?? null)===null||$tmp==='' ? "Tytuł domyślny" ?? null : $tmp);?>
</a>
        <ul>
            <li class="pure-menu-selected"><a href="#app_top">Góra strony</a></li>
            <li><a href="#app_content">Idź do formularza</a></li>
        </ul>
    </div>
</div>

<div class="splash-container">
    <div class="splash-content">
        <h1 class="splash-head">Projekt kalkulatora kredytowego z szablonowaniem</h1>
        <p class="splash-subhead">
            Profesjonalne szablonowanie oparte na bibliotece Smarty
        </p>
        <p>
            <a href="#app_content" class="pure-button pure-button-primary">Idź do formularza</a>
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div id="app_content" class="content">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15474759686739bc0178c053_54724227', 'content');
?>

    </div>
</div>

<div class="footer">
    <p>
        Projekt i wykonanie: Robert Krzykawski
    </p>
</div>

<div id="calculator_form">
    <!-- Placeholder for the calculator form -->
</div>

<!-- JavaScript for Smooth Scrolling -->
<?php echo '<script'; ?>
>
    document.querySelectorAll('.pure-button-primary').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('#calculator_form').scrollIntoView({ behavior: 'smooth' });
        });
    });
<?php echo '</script'; ?>
>

</body>
</html>
<?php }
/* {block 'content'} */
class Block_15474759686739bc0178c053_54724227 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_15474759686739bc0178c053_54724227',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 Domyślna treść zawartości... <?php
}
}
/* {/block 'content'} */
}
