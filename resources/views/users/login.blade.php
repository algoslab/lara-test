<form action="{{ route('login') }}" method="post">
    @csrf

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" >
  </div><br>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>