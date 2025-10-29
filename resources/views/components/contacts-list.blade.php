@props(['tag' => 'ul', 'class' => ''])
@php
$contacts = cache()->remember('active_contacts', 3600, function () {
    return \App\Models\Contact::select(['phone', 'name', 'telegram', 'instagram'])
        ->active()
        ->ordered()
        ->get()
        ->map(function($contact) {
        $digits = preg_replace('/\D+/', '', (string) $contact->phone);
        if (strlen($digits) === 10) {
            $digits = '7' . $digits;
        }
        if (strlen($digits) === 11 && $digits[0] === '8') {
            $digits = '7' . substr($digits, 1);
        }
        $display = $digits;
        if (strlen($digits) === 11 && $digits[0] === '7') {
            $display = '+7 (' . substr($digits, 1, 3) . ') ' . substr($digits, 4, 3) . '-' . substr($digits, 7, 2) . '-' . substr($digits, 9, 2);
        }
            return [
                'display' => $display,
                'name' => $contact->name,
                'telegram' => $contact->telegram,
                'instagram' => $contact->instagram
            ];
        });
});
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $class]) }}>
@foreach($contacts as $contact)
    <li>
        <strong>{{ $contact['display'] }}</strong> {{ $contact['name'] }} тел./viber/whatsapp
        @if($contact['telegram'] || $contact['instagram'])
            <br>
            @if($contact['telegram'])
                <a href="{{ $contact['telegram'] }}" target="_blank" style="color: #0088cc; text-decoration: none;">📱 Telegram</a>
            @endif
            @if($contact['telegram'] && $contact['instagram'])
                |
            @endif
            @if($contact['instagram'])
                <a href="{{ $contact['instagram'] }}" target="_blank" style="color: #e4405f; text-decoration: none;">📷 Instagram</a>
            @endif
        @endif
    </li>
@endforeach
</{{ $tag }}>


