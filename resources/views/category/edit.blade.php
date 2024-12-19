<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    @include('page_style.header')


    <div class="container">
      <div raw>
          <div class="col-mid-12">
              <div class="card">
                  <div class="card-header">
                      <h4>Edit Category
                          <a href="{{url('category')}}" class="btn btn-danger float-end">Back</a>
                      </h4>
                  </div>
                  <div class="card-body">
                      <form action="{{ route('category.update', $category->CategoryID)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="mb-3">
                              <label>Name</label>
                              <input type="text" name="Name" class="form-control" value="{{$category->Name}}"/>
                              @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="mb-3">
                              <label>Description</label>
                              <textarea type="text" name="Description" rows="3" class="form-control">{!! $category->Description !!}</textarea>
                              @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="mb-3">
                            <label for="Status">Status</label>
                            <select name="Status" id="Status" class="form-select">
                                <option value="1" {{ $category->Status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->Status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('Status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                          <div class="mb-3">
                              <button type="submit" class="btn btn-primary">Update</button>
                          </div>

                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

    
    {{-- @include('page_style.footer') --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>