<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<h4>List of Todos</h4>
@php
  $count = sizeof($todos);
@endphp
<span class="count_todos" count="{{ $count }}"></span>
<table class="table">
      <tbody>
          @foreach($todos as $data)
            <tr>
                <td>
                    <label class="form-check-label" for="check1">
                        <input type="checkbox"  todo_id = "{{ $data->id }}" class="form-check-input todo_check_status" id="check1" name="check" value="something" @if($data->status == '1') checked @endif > <!--  --><!-- <input type ='text' name="description" value="{{$data->description}}"> -->
                    </label>

                   <!--  <span class = "description_span" link_id = "{{ $data->id}}"> {{$data->description}} </span> -->
                    <input type="text" name="description" value="{{$data->description}}" class="description_todo " todo_id = "{{ $data->id }}">

                </td>
                <!-- <td class="td_description" style="display: none">
                  <input type="text" name="description" value="{{ $data->description }}">
                  <a class="btn btn-success text-white" >save</a>
                </td> -->
                <td>
                  <div class="input-group">
                     <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                              </span>
                                              <input type = "text" class = "datepicker-13" todo_id = "{{ $data->id }}" @if(!is_null($data->scheduled_date)) value = "{{ $data->scheduled_date }}" @endif>
                </div>
                </td>
                <td>
                    <a class="btn btn-danger delete_todo" todo_id = "{{ $data->id }}"><i class="fa fa-trash text-white"></i></a>
                </td>
            </tr>
           @endforeach               
         </tbody>
</table>

<script>

 $('document').ready(function() {

    var count = $('.count_todos').attr('count');
    if(count <= 0)
    {
        $('.panel_div').hide();
    }
    

    $('.datepicker-13').on('click', function() {
         $( this ).datepicker();
         $( this ).datepicker("show");
    });

    $('.description_todo').on('change', function() {
       var todo_id = $( this ).attr('todo_id');
       var description = $( this ).val();
       $.ajax({
                    type: 'POST',
                    
                    url: '/todo/updateDate/',
                    data: {
                            "_token": "{{ csrf_token() }}",
                            "id" : todo_id,
                            "description" : description,
                    },

                    success: function (data) { 
                      console.log(data);
                    }
                }); 
    });
   

    $('.datepicker-13').on('change', function() {
        var chosen_date = $( this ).val();
        var todo_id = $( this ).attr('todo_id');
         $.ajax({
                    type: 'POST',
                    
                    url: '/todo/updateDate/',
                    data: {
                            "_token": "{{ csrf_token() }}",
                            "id" : todo_id,
                            "date" : chosen_date,
                    },

                    success: function (data) { 
                      console.log(data);
                    }
                }); 
        
    });

    
        $('.todo_check_status').change(function() {

              var todo_id = $( this ).attr('todo_id');

          if (this.checked) 
            {
              var status = 1;
            } 
          else {
                var status = 0; 
                  }

           $.ajax({
                          type: 'POST',
                          
                          url: '/todo/updateDate',
                          data: {
                                  "_token": "{{ csrf_token() }}",
                                  "id" : todo_id,
                                  "status" : status,
                          },

                          success: function (data) { 
                            console.log(data);
                          }
                      }); 
        });


        $('.delete_todo').on('click', function() {
        var todo_id = $( this ).attr('todo_id');
         $.ajax({
                    type: 'POST',
                    
                    url: '/todo/delete',
                    data: {
                            "_token": "{{ csrf_token() }}",
                            "id" : todo_id,
                    },

                    success: function (data) { 
                       showlist();
                    }
                }); 
        
    });
 });

</script>