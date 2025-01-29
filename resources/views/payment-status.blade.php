<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-info">
                    <h4 class="mb-0">Payment Status</h4>
                </div>
                <div class="card-body">
                    <!-- Payment Status Icon and Message -->

                        @php
                            $paymentHeading = in_array($paymentData['status'],[ 'VALID','VALIDATED']) ? 'Payment Successful' : 'Payment Failed';
                            $class = in_array($paymentData['status'],[ 'VALID','VALIDATED']) ? 'text-success' : 'text-danger';

                        @endphp
                        <h5 class="{{ $class }}">{{ $paymentHeading }}!</h5>

                    <!-- Payment Details -->
                    <div class="mb-4 text-left">
                        <p><strong>Transaction ID:</strong> {{ $paymentData['tran_id'] }}</p>
                        <p><strong>Amount:</strong> {{ $paymentData['currency'] }} {{ $paymentData['amount'] }}</p>
                        <p><strong>Store
                                Amount:</strong> {{ $paymentData['currency'] }} {{ $paymentData['store_amount'] }}</p>
                        <p><strong>Payment Method:</strong> {{ $paymentData['card_type'] }}</p>
                        <p>
                            <strong>Date:</strong> {{ \Carbon\Carbon::make($paymentData['tran_date'])->format('d-M-Y, h:i:sA') }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
