<?php
/* Smarty version 4.3.0, created on 2023-02-22 05:38:42
  from 'C:\wamp64\www\smarty_excel\smarty\Smarty_excel\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63f5aa62a315e0_73186929',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5f2b5ac763ebe468bf59de0b3641bccc60b34db' => 
    array (
      0 => 'C:\\wamp64\\www\\smarty_excel\\smarty\\Smarty_excel\\templates\\index.tpl',
      1 => 1677044317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f5aa62a315e0_73186929 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Excel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-4 mb-5">
          <h2 class="mb-4 text-center">Excel File Export</h2>
          <hr>
          <form action="../modules/index.php" method="POST" enctype="multipart/form-data">
            <div class="card card-body shadow-sm">
              <div class="row">
                <div class="col-md-2 my-auto">
                  <h5>Select File: </h5>
                </div>
                <div class="col-md-4">
                  <input type="file" name="import_file" class="form-control">
                </div>
                <div class="col-md-4">
                  <button type="submit" name="import_file_btn" class="btn btn-primary">Upload</button>
                  <button type="submit" name="delete_file_btn" class="btn btn-danger">Delete</button>
                  <button type="submit" name="download_file_btn" class="btn btn-warning">Download</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Table for the data. -->
        <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>FULL NAME</th>
                <th>JOB TITLE</th>
                <th>DEPARTMENT</th>
                <th>GENDER</th>
                <th>AGE</th>
                <th>ANNUAL SALARY</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <tr>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['full_name'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['job_title'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['department'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['gender'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['age'];?>
</td>
                    <td class="border border-black-600 p-2"><?php echo $_smarty_tpl->tpl_vars['item']->value['annual_salary'];?>
</td>

                </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
      </div>
    </div>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    <?php echo '</script'; ?>
>
    
  </body>
</html>
<?php }
}
