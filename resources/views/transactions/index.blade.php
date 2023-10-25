@extends('layouts.app')

@section('content')
    <h2>Transactions</h2>

    <div class="container mt-2">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="container mt-3 mb-3">
        <div class="row">
            <!-- Card Balance -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-wallet-fill me-2"></i>
                        <span>Total Balance: {{ $balance }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Total Income -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-cash-stack me-2"></i> <!-- Ganti dengan ikon yang berkaitan -->
                        <span>Total Income: {{ $totalIncome }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Total Expense -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-cart-x-fill me-2"></i> <!-- Ganti dengan ikon yang berkaitan -->
                        <span>Total Expense: {{ $totalExpense }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Number of Income Transactions -->
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-plus-circle-fill me-2"></i>
                        <span>Number of Income Transactions: {{ $numIncomeTransactions }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Number of Expense Transactions -->
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-dash-square-fill me-2"></i>
                        <span>Number of Expense Transactions: {{ $numExpenseTransactions }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary float-end mb-2">Tambah<i class="bi bi-plus"></i></a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Category</th>
                <th>Notes</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->notes }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button type="button" class="btn btn-danger"
                                onclick="confirmDeletion('{{ route('transactions.destroy', $transaction) }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this transaction?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteTransactionForm" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function confirmDeletion(route) {
                $('#deleteTransactionForm').attr('action', route);
                $('#deleteModal').modal('show');
            }
        </script>
    @endpush
@endsection
