$(document).ready(function() {
      $('#student_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "ajaxdata/getdata",
        "columns":[
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "action",orderable:false,searchable:false }
            
        ]
     });
     
    $('#add_data').click(function(){
        $('#studentModal').modal('show');
        $('#student_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
    });

    $('#student_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            
            url:"ajaxdata/postdata",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_output').html(error_html);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('#student_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#student_table').DataTable().ajax.reload();
                }
            }
        });
    });
    //updating data
    $(document).on('click','.edit',function(){
        
        var id =$(this).attr("id");
   
         $.ajax({
            url:"ajaxdata/fetchdata",
            method:"GET",
            data:{id : id},
            dataType:"json",
            success:function(data)
            {
                $('#update_first_name').val(data.first_name);
                $('#update_last_name').val(data.last_name);
                $('#student_id').val(id);
                $('#studentUpdateModal').modal('show');
                $('#button_action').val('update');
               
            }
        });
    });
    
    //submitting update form
        $('#student_update_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            
            url:"ajaxdata/update_data",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_output').html(error_html);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('#student_form')[0].reset();
                    $('#button_action').val('update');
                    $('#student_table').DataTable().ajax.reload();
                }
            }
        });
    });
//deleting
$(document).on('click','.delete',function(){ 
        var id =$(this).attr("id");
        if(confirm("Are you sure you want to delete student ??")){
           $.ajax ({
               url : 'ajaxdata/remove_student',
               method : 'GET',
               data: {id : id},
               success : function(data){
                  
                  $('#student_table').DataTable().ajax.reload();
                  $('#feedback').html('<p class="alert alert-success">Student Deleted</p>');
               }
           });
        }
        else {
            return false;
        }
 });

});
