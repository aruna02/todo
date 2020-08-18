
 <div class="card">
     <div class="card-body table_body">

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
                                  <input type="checkbox"  todo_id = "{{ $data->id }}" class="form-check-input todo_check_status" id="check1" name="check" value="something" @if($data->status == '1') checked @endif > 
                              </label>

                           
                              <input type="text" name="description" value="{{$data->description}}" class="description_todo " todo_id = "{{ $data->id }}" title = "click to edit">

                          </td>
                          
                          <td>
                            <div class="input-group">
                               <span class="input-group-prepend">
                                                          
                                                        <input type = "date" class = "datepicker-13" todo_id = "{{ $data->id }}" title = "click to edit date" @if(!is_null($data->scheduled_date)) value = "{{ $data->scheduled_date }}" @endif>
                          </div>
                          </td>
                          <td>
                                <a class="btn btn-danger delete_todo" todo_id = "{{ $data->id }}"><i class="fa fa-trash text-white"></i></a>
                          </td>
                      </tr>
                     @endforeach               
                </tbody>
          </table>

      </div>

      <div class="filter_buttons text-right text-white m-2">
                    <a class="btn btn-primary filter_button" status = 2 >All</a>
                    <a class="btn btn-info filter_button" status = 0>Pending</a>
                    <a class="btn btn-success filter_button" status = 1>Complete</a>
      </div>

</div>

<script>

  $('document').ready(function() {
  

    var count = $('.count_todos').attr('count');
    if (count <= 0) {
      $('.panel_div').hide();
    }

    $('.description_todo').on('change', function() {
      var todo_id = $(this).attr('todo_id');
      var description = $(this).val();
      $.ajax({
        type: 'POST',

        url: '/todo/update/',
        data: {
          "_token": "{{ csrf_token() }}",
          "id": todo_id,
          "description": description,
        },

        success: function(data) {
          console.log(data);
        }
      });
    });


    $('.datepicker-13').on('change', function() {
      var chosen_date = $(this).val();
      var todo_id = $(this).attr('todo_id');
      $.ajax({
        type: 'POST',

        url: '/todo/update/',
        data: {
          "_token": "{{ csrf_token() }}",
          "id": todo_id,
          "date": chosen_date,
        },

        success: function(data) {
          console.log(data);
        }
      });

    });


    $('.filter_button').on('click', function() {

      var status = $(this).attr('status');
      $.ajax({
        type: 'GET',

        url: '/todo/' + status,



        success: function(data) {
          $('.todo_input').val('');
          $('.card_body').html(data);
          $('.panel_div').show();

        }
      });


    });


    $('.todo_check_status').change(function() {

      var todo_id = $(this).attr('todo_id');

      if (this.checked) {
        var status = 1;
      } else {
        var status = 0;
      }

      $.ajax({
        type: 'POST',

        url: '/todo/update',
        data: {
          "_token": "{{ csrf_token() }}",
          "id": todo_id,
          "status": status,
        },

        success: function(data) {
          console.log(data);
        }
      });
    });


    $('.delete_todo').on('click', function() {
      var todo_id = $(this).attr('todo_id');
      $.ajax({
        type: 'POST',

        url: '/todo/delete',
        data: {
          "_token": "{{ csrf_token() }}",
          "id": todo_id,
        },

        success: function(data) {
          showlist();
        }
      });

    });


  });



</script>
