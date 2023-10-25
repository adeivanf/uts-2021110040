@extends('layouts.app')

@section('content')
    <h2>Transaction Details</h2>

    <div class="container mt-4">

        <!-- Amount -->
        <div class="form-group">
            <label><strong>Amount:</strong></label>
            <p>{{ $transaction->amount }}</p>
        </div>

        <!-- Type -->
        <div class="form-group">
            <label><strong>Type:</strong></label>
            <p>{{ ucfirst($transaction->type) }}</p>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label><strong>Category:</strong></label>
            <p>{{ $transaction->category }}</p>
        </div>

        <!-- Notes -->
        <div class="form-group">
            <label><strong>Notes:</strong></label>
            <p>{{ $transaction->notes }}</p>
        </div>

        <a href="{{ route('transactions.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
