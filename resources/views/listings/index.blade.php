<x-layouts>
<div class="pagetitle">
    <h1>Data Table</h1>
  </div><!-- End Page Title -->
  <div>
      <a href="/create" class="btn btn-primary mb-3">Create New</a>
  </div>
  <section class="section">
    @if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
  <p>
    {{session('message')}}
  </p>
</div>
@endif
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">Hobby</th>
                  <th scope="col">Category</th>
                  <th scope="col">Profile pic</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lists as $list)

                <tr>
                  <td>{{$list->name}}</td>
                  <td>{{$list->number}}</td>
                  <td>{{$list->hobby_id}}</td>
                  <td>{{$list->Category->Category}}</td> 
                  <td><img src="/storage/{{$list->image}}" alt="image" width="100" height="100"></td>
                  <td><a href="/{{$list->id}}/edit" class="btn btn-success mb-3">Edit</a>
                    <form method="POST" action="/{{$list->id}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" id="delete-list" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form></td>
                </tr>
                    
                @endforeach
                
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
    $('#delete-form').on('submit', function(){
                event.preventDefault();
                var formData = new FormData(this);
                var id = $(this).data("id");
                var token = $(this).data("token");
                console.log(id);
                $.ajax({
                    url:"/"+id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response){
                        if(response.success){
                            alert('Data Deleted Successfully');
                            window.location.href = '/';
                        }
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
  </script>
</x-layouts>