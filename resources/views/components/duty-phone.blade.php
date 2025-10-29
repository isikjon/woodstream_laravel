@props(['class' => ''])
@php
$dutyData = cache()->remember('duty_phone_' . now()->format('Y-m-d'), 3600, function () {
    try {
        $dutyService = app(\App\Services\DutyScheduleService::class);
        $duty = $dutyService->getTodayDuty();
        $phone = $duty?->manager?->phone;
        
        $formatted = $phone;
        if ($phone) {
            $digits = preg_replace('/\D+/', '', $phone);
            if (strlen($digits) === 10) {
                $digits = '7' . $digits;
            }
            if (strlen($digits) === 11 && $digits[0] === '8') {
                $digits = '7' . substr($digits, 1);
            }
            if (strlen($digits) === 11 && $digits[0] === '7') {
                $formatted = '+7 (' . substr($digits, 1, 3) . ') ' . substr($digits, 4, 3) . '-' . substr($digits, 7, 2) . '-' . substr($digits, 9, 2);
            }
        }
        
        return [
            'phone' => $formatted,
            'href' => $phone ? 'tel:+7'.preg_replace('/\D+/', '', substr($phone, 1)) : null
        ];
    } catch (\Exception $e) {
        return [
            'phone' => null,
            'href' => null
        ];
    }
});
@endphp

@if($dutyData['phone'] && $dutyData['href'])
<a href="{{ $dutyData['href'] }}" {{ $attributes->merge(['class' => $class]) }}>{{ $dutyData['phone'] }}</a>
@endif


