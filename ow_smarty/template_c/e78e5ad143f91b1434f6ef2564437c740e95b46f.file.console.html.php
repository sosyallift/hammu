<?php /* Smarty version Smarty-3.1.12, created on 2015-06-23 08:46:42
         compiled from "E:\wamp\www\hammu\ow_system_plugins\base\views\components\console.html" */ ?>
<?php /*%%SmartyHeaderCode:4560558900d23f84e9-20012283%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e78e5ad143f91b1434f6ef2564437c740e95b46f' => 
    array (
      0 => 'E:\\wamp\\www\\hammu\\ow_system_plugins\\base\\views\\components\\console.html',
      1 => 1432102851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4560558900d23f84e9-20012283',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_558900d24149f9_16492910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_558900d24149f9_16492910')) {function content_558900d24149f9_16492910($_smarty_tpl) {?><?php if (!is_callable('smarty_block_style')) include 'E:\\wamp\\www\\hammu\\ow_smarty\\plugin\\block.style.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('style', array()); $_block_repeat=true; echo smarty_block_style(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


html div.ow_console_list_wrapper
{
    min-height: 0px;
    max-height: 257px;
}

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_style(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="ow_console clearfix">
    <div class="ow_console_body clearfix">
        <div style="ow_floatright">
            <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                <?php echo $_smarty_tpl->tpl_vars['item']->value;?>

            <?php } ?>
        </div>
    </div>
</div><?php }} ?>