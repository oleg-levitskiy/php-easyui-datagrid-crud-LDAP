<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Items</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="../css/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>	
</head>
<body>
	<table id="dg" title="ItemsTable" class="easyui-datagrid" style="width:100%;height:300"
			url="Ldap_get.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="objectclass" width="50">objectclass</th>
				<th field="cn" width="50">cn</th>				
				<th field="givenname" width="50">givenname</th>
				<th field="sn" width="50">sn</th>
				<th field="mail" width="50">mail</th>
				<th field="telephonenumber" width="50">telephonenumber</th>
				<th field="mobile" width="50">mobile</th>
				<th field="homephone" width="50">homephone</th>
				<th field="departmentnumber" width="50">departmentnumber</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New LDAP Item</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Edit LDAP Item</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Remove LDAP Item</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:450px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">LDAP Item Settings</div>
		<form id="fm" method="post" novalidate>
			<div class="fItem">
				<label>cn:</label>
				<input name="cn" class="easyui-textbox">
			</div>			
			<div class="fItem">
				<label>givenname:</label>
				<input name="givenname" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>sn:</label>
				<input name="sn" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>mail:</label>
				<input name="mail" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>telephonenumber:</label>
				<input name="telephonenumber" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>mobile:</label>
				<input name="mobile" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>homephone:</label>
				<input name="homephone" class="easyui-textbox">
			</div>
			<div class="fItem">
				<label>departmentnumber:</label>
				<input name="departmentnumber" class="easyui-textbox">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveItem()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		function newItem(){
			$('#dlg').dialog('open').dialog('setTitle','New Item');
			$('#fm').form('clear');
			url = 'Ldap_save.php';
		}
		function editItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Item');
				$('#fm').form('load',row);
				url = 'Ldap_update.php?cn='+row.cn;
			}
		}
		function saveItem(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the Item data
					}
				}
			});
		}
		function destroyItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this Item?',function(r){
					if (r){
						$.post('Ldap_destroy.php',{cn:row.cn},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the Item data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fItem{
			margin-bottom:5px;
		}
		.fItem label{
			display:inline-block;
			width:100px;
		}
		.fItem input{
			width:200px;
		}
	</style>
</body>
</html>