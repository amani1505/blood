<form action="{{ route('requestHistory.store') }}" method="POST" id="create">
    @csrf
    @method('POST')
    <input type="hidden" name="volume" value="{{ $volume }}">
    <input type="hidden" name="blood_type_id" value="{{ $bloodTypeId }}">
    <input type="hidden" id="hospital_id" name="hospital_id" value="">
    <!-- Include any fields or elements for the request form here -->
  

    <!-- Display blood stock information -->
    <div class="">
        <h5 class="my-3">Blood Stock Information</h5>
        <div class="row">
            @foreach($bloodStocks as $bloodStock)
                <div class="col-md-3">
        
                        <div class="mb-4">
                            <div class="card h-auto">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center justify-content-end" >
                                        <div class="text-dark mx-2">
                                            <h4>{{ $bloodStock->bloodType->group }}</h4>
                                        </div>
                                        <div class="">
                                            <i class="fas fa-tint fa-2x text-danger "></i>
                                        </div>
                                    </div>
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                                {{$bloodStock->hospital->name}}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $volume }}
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success mt-3 w-100" onclick="selectBloodStock({{ $bloodStock->hospital_id }})">Submit Request</button>
                                    
                                </div>
                            </div>
                        </div>
                    
                </div>
                
            @endforeach
            </div>
    </div>

   
</form>

<script>
    function selectBloodStock(bloodStockId) {
        document.getElementById('hospital_id').value = bloodStockId;
        document.getElementById('create').submit();
    }
</script>
</body>
</html>