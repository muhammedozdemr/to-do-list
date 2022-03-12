<button type="button"
        class="btn btn-danger btn-sm delete-btn"
        data-url="{{ $url }}"
        data-title="{{ $title ?? __('general.are_you_sure') }}"
        data-text="{{ $text ?? __('general.cant_be_undone') }}"
        data-yes="{{ $text ?? __('general.yes') }}"
        data-no="{{ $text ?? __('general.no') }}">
    Delete
</button>
