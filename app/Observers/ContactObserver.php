<?php

namespace App\Observers;

use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class ContactObserver
{
    public function created(Contact $contact): void
    {
        $this->clearCache();
    }

    public function updated(Contact $contact): void
    {
        $this->clearCache();
    }

    public function deleted(Contact $contact): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('active_contacts');
    }
}
