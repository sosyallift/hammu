<?php /* Smarty version Smarty-3.1.12, created on 2015-05-12 10:15:12
         compiled from "/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/controllers/preference_index.html" */ ?>
<?php /*%%SmartyHeaderCode:197363714055520af0572520-89616689%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b9c4ac9e171e6a08ba1acfb36c2ae7f79f9954f' => 
    array (
      0 => '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/controllers/preference_index.html',
      1 => 1430993628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197363714055520af0572520-89616689',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'contentMenu' => 0,
    'preferenceList' => 0,
    'section' => 0,
    'sectionLabels' => 0,
    'preferences' => 0,
    'preference' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_55520af064b955_99009601',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55520af064b955_99009601')) {function content_55520af064b955_99009601($_smarty_tpl) {?><?php if (!is_callable('smarty_block_style')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/block.style.php';
if (!is_callable('smarty_block_block_decorator')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/block.block_decorator.php';
if (!is_callable('smarty_function_text')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.text.php';
if (!is_callable('smarty_block_form')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/block.form.php';
if (!is_callable('smarty_function_cycle')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_libraries/smarty3/plugins/function.cycle.php';
if (!is_callable('smarty_function_label')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.label.php';
if (!is_callable('smarty_function_input')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.input.php';
if (!is_callable('smarty_function_error')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.error.php';
if (!is_callable('smarty_function_desc')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.desc.php';
if (!is_callable('smarty_function_submit')) include '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_smarty/plugin/function.submit.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('style', array()); $_block_repeat=true; echo smarty_block_style(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


tr.ow_preference td.ow_label{
    width:30%
}

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_style(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php echo $_smarty_tpl->tpl_vars['contentMenu']->value;?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('block_decorator', array('name'=>"box",'type'=>"empty",'addClass'=>"ow_superwide ow_automargin")); $_block_repeat=true; echo smarty_block_block_decorator(array('name'=>"box",'type'=>"empty",'addClass'=>"ow_superwide ow_automargin"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if (empty($_smarty_tpl->tpl_vars['preferenceList']->value)){?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('block_decorator', array('name'=>"box",'type'=>"empty",'addClass'=>"ow_center",'style'=>"padding:15px;")); $_block_repeat=true; echo smarty_block_block_decorator(array('name'=>"box",'type'=>"empty",'addClass'=>"ow_center",'style'=>"padding:15px;"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

             <?php echo smarty_function_text(array('key'=>"base+preference_no_items"),$_smarty_tpl);?>

        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_block_decorator(array('name'=>"box",'type'=>"empty",'addClass'=>"ow_center",'style'=>"padding:15px;"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }else{ ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('name'=>'preferenceForm')); $_block_repeat=true; echo smarty_block_form(array('name'=>'preferenceForm'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <table class="ow_table_1 ow_form">
                <?php  $_smarty_tpl->tpl_vars['preferences'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preferences']->_loop = false;
 $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['preferenceList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['preferences']->key => $_smarty_tpl->tpl_vars['preferences']->value){
$_smarty_tpl->tpl_vars['preferences']->_loop = true;
 $_smarty_tpl->tpl_vars['section']->value = $_smarty_tpl->tpl_vars['preferences']->key;
?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['section']->value)){?>
                        <tr class="ow_name ow_txtleft ow_tr_first">
                            <th colspan="3">
                                <?php if (!empty($_smarty_tpl->tpl_vars['sectionLabels']->value[$_smarty_tpl->tpl_vars['section']->value]['label'])){?>
                                    <span class="ow_section_icon <?php if (!empty($_smarty_tpl->tpl_vars['sectionLabels']->value[$_smarty_tpl->tpl_vars['section']->value]['iconClass'])){?> <?php echo $_smarty_tpl->tpl_vars['sectionLabels']->value[$_smarty_tpl->tpl_vars['section']->value]['iconClass'];?>
 <?php }?>">
                                        <?php echo $_smarty_tpl->tpl_vars['sectionLabels']->value[$_smarty_tpl->tpl_vars['section']->value]['label'];?>

                                    </span>
                                <?php }else{ ?>
                                    <?php echo $_smarty_tpl->tpl_vars['section']->value;?>

                                <?php }?>
                            </th>
                        </tr>
                    <?php }?>
                    <?php  $_smarty_tpl->tpl_vars['preference'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preference']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['preferences']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['preference']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['preference']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['preference']->key => $_smarty_tpl->tpl_vars['preference']->value){
$_smarty_tpl->tpl_vars['preference']->_loop = true;
 $_smarty_tpl->tpl_vars['preference']->iteration++;
 $_smarty_tpl->tpl_vars['preference']->last = $_smarty_tpl->tpl_vars['preference']->iteration === $_smarty_tpl->tpl_vars['preference']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['preference']['last'] = $_smarty_tpl->tpl_vars['preference']->last;
?>
                        <tr class="ow_preference <?php echo smarty_function_cycle(array('name'=>$_smarty_tpl->tpl_vars['section']->value,'values'=>'ow_alt1,ow_alt2'),$_smarty_tpl);?>
 <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['preference']['last']){?>ow_tr_last<?php }?>">
                            <td class="ow_label">
                                <?php echo smarty_function_label(array('name'=>$_smarty_tpl->tpl_vars['preference']->value),$_smarty_tpl);?>

                            </td>
                            <td class="ow_value">
                                <?php echo smarty_function_input(array('name'=>$_smarty_tpl->tpl_vars['preference']->value),$_smarty_tpl);?>

                                <div style="height:1px;"></div>
                                <?php echo smarty_function_error(array('name'=>$_smarty_tpl->tpl_vars['preference']->value),$_smarty_tpl);?>

                            </td>
                            <td class="ow_desc">
                                <?php echo smarty_function_desc(array('name'=>$_smarty_tpl->tpl_vars['preference']->value),$_smarty_tpl);?>

                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
            <div class="clearfix ow_stdmargin"><div class="ow_right">
            <?php echo smarty_function_submit(array('name'=>'preferenceSubmit'),$_smarty_tpl);?>

			</div></div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('name'=>'preferenceForm'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_block_decorator(array('name'=>"box",'type'=>"empty",'addClass'=>"ow_superwide ow_automargin"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>