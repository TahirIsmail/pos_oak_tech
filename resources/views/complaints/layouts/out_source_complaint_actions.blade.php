<div class="dropdown">
    <button class="btn btn-sm btn-outline-primary dropdown-toggle actions-dropdown-btn" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h actions-dropdown"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
        @if (check_access(array('VIEW_OUT_SOURCE_COMPLAINTS'), true))
            <a href="view_out_source_complaint/{{ $row->id }}" class="dropdown-item">{{ __("View") }}</a>
        @endif
       
    </div>
</div>