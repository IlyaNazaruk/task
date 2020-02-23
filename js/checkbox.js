function sel_all(){
    if( !document.form_name1.delete_row ) return;
    if( !document.form_name1.delete_row.length )
        document.form_name1.delete_row.checked = document.form_name1.delete_row.checked ? false : true;
    else
        for(var i=0;i<document.form_name1.delete_row.length;i++)
            document.form_name1.delete_row[i].checked = document.form_name1.delete_row[i].checked ? false : true;
}