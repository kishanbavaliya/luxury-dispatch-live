@extends('admin.layouts.app')

@section('title', 'Commission Overview')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3>{{ $page }}</h3>

                    <form method="get" action="{{ route('commissionReport') }}" class="form-inline float-right">
                        <label for="filter" class="mr-2">Filter:</label>
                        <select name="filter" class="form-control mr-2" onchange="toggleDateInputs()">
                            <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ $filter == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                        <div id="dateInputs" class="" style="display: {{ $filter == 'custom' ? 'inline' : 'none' }};">
                            <label for="from_date" class="mr-1">From:</label>
                            <input type="date" name="from_date" class="form-control mr-2" value="{{ $from_date ?? '' }}">
                            <label for="to_date" class="mr-1">To:</label>
                            <input type="date" name="to_date" class="form-control mr-2" value="{{ $to_date ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="box-body">

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <strong>Total Commission:</strong> ${{ number_format($totalCommission, 2) }}
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="alert alert-secondary">
                                <strong>Commission per Company:</strong>
                                <ul class="mb-0">
                                    @forelse ($partnerCommissions as $partner)
                                        <li>{{ $partner['partner_name'] }}: ${{ number_format($partner['commission'], 2) }}</li>
                                    @empty
                                        <li>No records found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Commission Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($commissions as $index => $commission)
                                <tr>
                                    <td>{{ $commissions->firstItem() + $index }}</td>
                                    <td>
                                        {{
                                            DB::table('owners')
                                                ->where('id', $commission->user_id)
                                                ->value('company_name') ?? 'Unknown'
                                        }}
                                    </td>
                                    <td>${{ number_format($commission->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($commission->created_at)->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4">No commission data found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $commissions->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

<script>
function toggleDateInputs() {
    var filter = document.querySelector('select[name="filter"]').value;
    var dateInputs = document.getElementById('dateInputs');
    var fromDate = document.querySelector('input[name="from_date"]');
    var toDate = document.querySelector('input[name="to_date"]');

    if (filter === 'custom') {
        dateInputs.style.display = 'inline';
    } else {
        dateInputs.style.display = 'none';

        // Clear dates when not custom
        if (fromDate) fromDate.value = '';
        if (toDate) toDate.value = '';
    }
}
</script>
