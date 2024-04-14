@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Request History</h1>
</div>
<div class="container bg-white rounded p-4">
    <div class="pull-right mb-1">
        <a class="btn btn-light" href="{{ route('requestHistory.histories') }}" enctype="multipart/form-data">
            <i class="fas fa-angle-left"></i>
        </a>
    </div>
    <h4 class="mb-3">Check Available Stock</h4>
    <!-- Form -->
    <form  id="check-form"   action="{{ route('requestHistory.check') }}" method="POST">
        @csrf

        <div class="row align-items-center">
            <div class="col-md-5 mb-md-0 mb-3">
                {{-- <label for="quantity" class="form-label">Volume</label> --}}
                <input type="number" class="form-control" id="volume" placeholder="Enter Volume" name="volume" required>
            </div>
            <div class="col-md-5 mb-md-0 mb-3">
                {{-- <label for="blood_type" class="form-label">Blood Type</label> --}}
                <select class="custom-select" aria-label="Default select example" id="blood_type_id" name="blood_type_id" required>
                    <option selected disabled>Select blood type</option>
                    @foreach($bloodTypes as $bloodType)
                    <option value="{{ $bloodType->id }}">{{ $bloodType->group }}</option>
                    @endforeach
                </select>
            </div>
    
           <div class="col-md-2 mb-md-0 mb-3">
            <button type="submit" class="btn btn-primary w-100">Check</button>
           </div>
        </div>
    </form>

    <div  id="request-form">
        <form action="" ></form>
       </div>

<div id="popup-banner" class="popup-banner"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Submit form using Ajax
$('#check-form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            if (response.success) {
                // Blood stock is available, display the request form
                $('#request-form').html(response.html);
            } else {
                // Display error message
                $('#popup-banner').text(response.message).show();
                $('#request-form').empty(); 
                setTimeout(function () {
                    $('#popup-banner').fadeOut('slow');
                }, 3000);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});


</script>
</body>
</html>
</div>



@endsection
