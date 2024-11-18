<?php
/* Smarty version 4.5.4, created on 2024-11-17 11:02:42
  from 'C:\xampp\htdocs\php_05_kontroler_glowny\app\calc\CalcView.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6739bf42e85692_97236903',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca17c6781b740e34422f6c15370b5ae158595bb3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_05_kontroler_glowny\\app\\calc\\CalcView.html',
      1 => 1731837714,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6739bf42e85692_97236903 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8741969316739bf42e7ec54_33863611', "footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13192453206739bf42e7f2f4_25192456', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ($_smarty_tpl->tpl_vars['conf']->value->root_path).("/templates/main.html"));
}
/* {block "footer"} */
class Block_8741969316739bf42e7ec54_33863611 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_8741969316739bf42e7ec54_33863611',
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
class Block_13192453206739bf42e7f2f4_25192456 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_13192453206739bf42e7f2f4_25192456',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<h2 class="content-head is-center">Prosty kalkulator</h2>

<div class="pure-g">
    <div class="l-box-lrg pure-u-1 pure-u-med-2-5">
        <form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['action_root']->value;?>
calcCompute" method="post">
            <fieldset>
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
            </fieldset>
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
<?php }?>
</div>
<?php
}
}
/* {/block "content"} */
}
