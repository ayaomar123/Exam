<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="row mt-5">
    <h3>Welcome to {{$account->currency}}</h3>
    </div>
    <div class="row mt-5">
        <h4>info:</h4>
        <h6> Account Number : {{$account->number}}</h6>
        <h6> Account Balance : {{$account->BalanceText}}</h6>

    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <form action="{{route('debit',$account->id)}}" method="post">
                @csrf
                <label for="">Amount</label>
                <input type="number" name="amount">
                <button type="submit">Debit</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{route('credit',$account->id)}}" method="post">
                @csrf
                <label for="">Amount</label>
                <input type="number" name="amount">
                <button type="submit">credit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
