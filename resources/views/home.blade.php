@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <h4>
        <span class="todo-fonts"> Todos </span>
        <input type="text" name="name" class="search_by_name" placeholder="search by name...">
        <button class="add_todo btn btn-primary text-white btn-purple" data-original-title="Add todo"><i class="fa fa-plus"></i></button>
    </h4>
</div>

<div class="add_todo_div container mb-4" style="display: none;">
    <div class="row">
        <div class="col-8 ml-3">
            <input type="text" name="text" class="todo_input form-control" placeholder="Enter Todo" >
            <span class="text-danger danger_span" style="display:none">this field is empty</span>
        </div>
        <div class="col-2">
            <a type="button" class="btn btn-success text-white add_btn">Add</a>
            <a type="button" class="btn btn-danger text-white cancel_btn">Cancel</a>
        </div>
         
    </div>
</div>

<div class="container mt-3 panel_div" >
    <div class="col-10">
        <div class="card">
            <div class="card-body table_body">
            </div>
            <div class="filter_buttons text-right text-white">
                <a class="btn btn-primary filter_button" status = 2 >All</a>
                <a class="btn btn-info filter_button" status = 0>Pending</a>
                <a class="btn btn-success filter_button" status = 1>Complete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('document').ready(function() {
        showlist();
      
        //for add btn
        $('.add_btn').on('click',function() {
            if($('.todo_input').val() == '')
            {
                $('.danger_span').show();
            }
            else {
                $('.danger_span').hide();
                var todo_data = $('.todo_input').val();
                $.ajax({
                    type: 'GET',
                  
                    url: '/todo/add/'+todo_data,
                    

                    success: function (data) { 
                       $('.todo_input').val('');
                       showlist();
                       $('.panel_div').show();
                       // $('.add_todo_div').hide();
                    }
                }); 
               
            }
        });

        //for cancel btn
         $('.cancel_btn').on('click',function() {
             $('.danger_span').hide();
            $('.todo_input').val('');
        });


        //for add todo btn 
        $('.add_todo').on('click',function() {
            $('.add_todo_div').show();
        });

            //for input field
        $( "input[type='text']" ).keyup(function() {
            $('.danger_span').hide();
        });

         $('.filter_button').on('click',function() {
            
                var status = $(this).attr('status');
                $.ajax({
                    type: 'GET',
                  
                    url: '/todo/'+status,
                    
                    

                    success: function (data) { 

                       $('.todo_input').val('');
                        $('.table_body').html(data);
                        $('.panel_div').show();
                    }
                }); 
               
            
        });


         $('.search_by_name').on('keyup',function() {
            
                var name = $(this).val();
                if(name != '')
                {
                    $.ajax({
                        type: 'GET',
                      
                        url: '/todo/search/'+name,
                        
                        

                        success: function (data) { 

                            $('.table_body').html(data);
                            $('.panel_div').show();
                        }
                     }); 
                }

                else
                {
                    showlist();
               
                }
               
            
        });


         


    });

     function showlist() {
            $.ajax({
                    type: 'GET',
                  
                    url: '/todo/2',
                    

                    success: function (data) { 
                       $('.table_body').html(data);
                       $('.panel_div').show();
                    }
                }); 
         }
</script>



@endsection
