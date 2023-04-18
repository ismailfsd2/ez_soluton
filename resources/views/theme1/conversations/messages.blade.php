
@foreach($rows as $row)
    <div class="d-flex mb-4">
        <div class="flex-shrink-0">
            <img src="<?php echo asset('assets/images/users/user-dummy-img.jpg'); ?>" alt="" class="avatar-xs rounded-circle">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="fs-13">
                @if($row->user_type == "employee" )
                    {{ $row->employee }}
                @elseif ($row->user_type == "vendor" )
                    {{ $row->vendor }}
                @elseif ($row->user_type == "customer" )
                    {{ $row->customer }}
                @endif
                ({{ ucwords($row->user_type) }})
                <small class="text-muted ms-2">{{ $row->created_at->format('d M Y h:i:s A') }}</small></h5>
            <p class="text-muted">{{ $row->message}}</p>
        </div>
    </div>
@endforeach