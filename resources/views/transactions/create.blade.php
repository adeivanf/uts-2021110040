@extends('layouts.app')

@section('content')
    <h2>Create Transaction</h2>

    <div class="container mt-4">
        <form action="{{ route('transactions.store') }}" method="post">
            @csrf

            <!-- Amount -->
            <div class="form-group mb-2">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div class="form-group mb-2">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>
                @error('type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="form-group mb-2">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}">
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Notes -->
            <div class="form-group mb-3">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <a href="{{ route('transactions.index') }}" class="btn btn-info">Back</a>
            <button type="submit" class="btn btn-success">Create Transaction</button>
        </form>
    </div>
@endsection
