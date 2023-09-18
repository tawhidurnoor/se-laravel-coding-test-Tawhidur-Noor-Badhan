@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Withdrawals
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                        Withdraw Money
                    </button>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Transaction Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <th>{{$transaction->transaction_type}}</th>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->fee}}</td>
                                <td>{{$transaction->date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Withdraw Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('withdrawal-money')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="number" class="form-control" name="user_id" placeholder="User ID" required>
                    <input type="number" class="form-control" name="withdraw_amount" step="any" placeholder="withdrawal Amount" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">withdraw</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection