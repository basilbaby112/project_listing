<x-layouts>
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Data</h5>

                <!-- General Form Elements -->
                <form  id="data-form" enctype="multipart/form-data">
                    @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" name="number" value="{{old('number')}}">
                    @error('number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Hobby</label>
                    <div class="col-sm-10">
                    <select class="form-select" id="hobby-select" multiple aria-label="multiple select example" name="hobby_id[]" value="{{old('hobby')}}">
                        @foreach ($hobbies as $value)
                            <option value="{{$value->hobby}}">{{$value->hobby}}</option>
                        @endforeach
                    </select>
                    @error('hobby')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="category_id" value="{{old('category')}}">
                        <option selected>Select</option>
                @foreach ($category as $value)
                    <option value="{{$value->id}}">{{$value->Category}}</option>
                @endforeach
                        
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" name="image">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                </div>

                </form><!-- End General Form Elements -->

            </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(function(){
        $('#hobby-select').select2();

        $('#data-form').on('submit', function(){
            event.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url:"{{route('list.store')}}",
                type: 'POST',
                data:formData,
                success: function(response){
                    if(response.success){
                        alert('Data saved successfully');
                        $('#data-form').trigger("reset");
                        $('#hobby-select').val('').trigger("change");
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

    })
</script>
</x-layouts>