<?php /* Smarty version Smarty-3.1.12, created on 2015-05-12 01:29:46
         compiled from "/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/components/widget_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:19874779555518fcac27800-94746637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00398a6375919635e7a292a13e1c011a59d0cc87' => 
    array (
      0 => '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/components/widget_menu.html',
      1 => 1430993618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19874779555518fcac27800-94746637',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'tab' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_55518fcac3d629_53087696',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55518fcac3d629_53087696')) {function content_55518fcac3d629_53087696($_smarty_tpl) {?><div class="clearfix">
	<div class="ow_box_menu">
		<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
			<a href="javascript://" id="<?php echo $_smarty_tpl->tpl_vars['tab']->value['id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['tab']->value['active'])&&$_smarty_tpl->tpl_vars['tab']->value['active']){?> class="active"<?php }?>><span><?php echo $_smarty_tpl->tpl_vars['tab']->value['label'];?>
</span></a>
		<?php } ?>
	</div>
</div><?php }} ?>