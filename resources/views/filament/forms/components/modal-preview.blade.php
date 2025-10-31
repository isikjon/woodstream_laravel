@php
    $record = $getRecord();
@endphp

@if($record && $record->is_fixed)
<div style="background: #f9fafb; border-radius: 8px; padding: 20px; border: 1px solid #e5e7eb;">
    <div style="margin-bottom: 15px;">
        <span style="font-weight: 600; font-size: 14px; color: #374151;">Изображение модального окна:</span>
    </div>
    <div style="max-width: 600px; margin: 0 auto;">
        <img src="{{ $record->image }}" alt="Превью модалки" style="width: 100%; height: auto; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    </div>
</div>
@endif

