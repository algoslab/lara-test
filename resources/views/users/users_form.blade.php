<form action="{{ route('users_create') }}" method="post">
    @csrf
 <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div><br>

  <div class="form-floating">
    <label for="account_type" class="form-label">Account Type</label>
    <select class="form-select" name="account_type" >
        <option value="Individual">Individual</option>
        <option value="Business">Business</option>
    </select>
  </div><br>

  <div class="mb-3">
    <label for="balance" class="form-label">Balance</label>
    <input type="text" class="form-control" id="balance" name="balance">
  </div><br>

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