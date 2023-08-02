<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <h1>Create customers</h1>

    </div>


  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
  <form  method="post" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
@csrf
<div class="mb-3">
  <label for="firstName" class="form-label">First Name</label>
  <input type="text" name="first_name" class="form-control" id="firstName">
</div>
<div class="mb-3">
  <label for="lastName" class="form-label">Last Name</label>
  <input type="text" name="last_name" class="form-control" id="lastName">
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email" name="email" class="form-control" id="email">
</div>
<div class="mb-3">
  <label for="phone" class="form-label">Phone</label>
  <input type="text" name="phone" class="form-control" id="phone">
</div>
<div class="mb-3">
<label for="image" class="form-label">Image</label>

<input type="file" class="form-control" id="image" name="image" required>
</div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
