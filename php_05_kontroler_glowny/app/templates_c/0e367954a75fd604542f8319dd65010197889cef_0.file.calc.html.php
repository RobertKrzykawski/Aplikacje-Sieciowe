<?php
/* Smarty version 4.5.4, created on 2024-11-10 18:56:07
  from 'C:\xampp\htdocs\php_04_obiektowosc\app\calc.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6730f3b785cf73_41134498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e367954a75fd604542f8319dd65010197889cef' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_04_obiektowosc\\app\\calc.html',
      1 => 1730918288,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6730f3b785cf73_41134498 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2028086216730f3b76ecb28_64769335', "footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19627456730f3b76ede25_57937144', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "../templates/main.html");
}
/* {block "footer"} */
class Block_2028086216730f3b76ecb28_64769335 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_2028086216730f3b76ecb28_64769335',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

Przykładowa treść stopki wpisana do szablonu głównego z szablonu kalkulatora
<?php
}
}
/* {/block "footer"} */
/* {block "content"} */
class Block_19627456730f3b76ede25_57937144 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19627456730f3b76ede25_57937144',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<h2>Kalkulator kredytowy</h2>

<div class="form-container">
    <form action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/calc.php" method="post">
        <label for="id_amount">Kwota kredytu:</label><br>
        <input id="id_amount" type="text" name="amount" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['amount']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><br>

        <label for="id_years">Liczba lat:</label><br>
        <input id="id_years" type="number" name="years" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['years']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><br>

        <label for="id_interest">Oprocentowanie roczne (%):</label><br>
        <input id="id_interest" type="number" name="interest" min="0" step="0.01" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['interest']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><br>

        <input type="submit" value="Oblicz">
    </form>
</div>

<?php if ((isset($_smarty_tpl->tpl_vars['messages']->value)) && count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
    <div class="error-messages">
        <h4>Wystąpiły błędy:</h4>
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
                <li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php }?>

<?php if ((isset($_smarty_tpl->tpl_vars['result']->value))) {?>
    <div class="result">
        <h4>Wynik</h4>
        Miesięczna rata kredytu: <?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 zł
    </div>
<?php }
}
}
/* {/block "content"} */
}
