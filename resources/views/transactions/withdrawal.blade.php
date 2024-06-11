<form action="{{ route('withdraw_post') }}" method="post">
    @csrf

  <div class="mb-3">
    <label for="amount" class="form-label">Withdraw Amount</label>
    <input type="text" class="form-control" id="amount" name="amount">
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div>
    
        <table>
            <thead>
                <th>User</th>
                <th>Transaction type</th>
                <th>Amount</th>
                <th>Fee</th>
                <th>Date</th>
            </thead>
            <tbody>
                @foreach($widthdraws as $depo)
                <tr>
                    <td>{{ $depo->user_id }}</td>
                    <td>{{ $depo->transaction_type }}</td>
                    <td>{{$depo->amount}}</td>
                    <td>{{ $depo->fee }}</td>
                    <td>{{ $depo->date }}</td>  
                </tr>
                @endforeach
            </tbody>
        </table>

    
</div>