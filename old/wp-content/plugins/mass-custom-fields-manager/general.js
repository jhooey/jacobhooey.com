function isValid(form) {
	ret=true;

	if ( empty(form.field.value) ) {	
		err='The "Field name" field is empty.';
		ret=false;
	}
	
	if( !ret )
		alert(err);
	
	return ret;
}

function toggleDelete() {
	var form=document.getElementById('frmMain');
	var ckd= (form.deletee.checked);

	form.new_value.disabled=ckd;
}

function empty( mixed_var ) {
    var key;
    
    if (mixed_var === "" ||
        mixed_var === 0 ||
        mixed_var === "0" ||
        mixed_var === null ||
        mixed_var === false ||
        mixed_var === undefined
    ){
        return true;
    }

    if (typeof mixed_var == 'object') {
        for (key in mixed_var) {
            return false;
        }
        return true;
    }

    return false;
}

function deleteRow(id) {
	document.getElementById('row'+id).innerHTML='';

	return false;
}
function addMore(){
	var tbody = document.getElementById('op_table').getElementsByTagName("TBODY")[0];

	var row = document.createElement("TR");

	var td1 = document.createElement("TD");
	td1.innerHTML='<input type="text" name="mcfm_lftag[]" />';

	var td2 = document.createElement("TD");
	td2.innerHTML='<input type="text" name="mcfm_fname[]" />';

	var td3 = document.createElement("TD");
	td3.innerHTML='<input type="text" name="mcfm_fvalue[]" />';

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);

	tbody.appendChild(row);

	return false;
  }