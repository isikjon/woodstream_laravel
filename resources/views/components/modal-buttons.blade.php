@props(['modal'])

<div class="modal-buttons" style="display: flex; gap: 15px; justify-content: center;">
    @if($modal->button_1_text && $modal->button_1_url)
        <a href="{{ $modal->button_1_type === 'telegram' ? 'https://t.me/' . ltrim($modal->button_1_url, '@') : ($modal->button_1_type === 'whatsapp' ? 'https://wa.me/' . preg_replace('/[^\d]/', '', $modal->button_1_url) : $modal->button_1_url) }}" 
           target="_blank"
           style="
               flex: 1;
               padding: 8px 12px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 400;
               font-size: 15px;
               text-align: center;
               transition: all 0.3s ease;
               display: block;
               {{ $modal->button_1_type === 'telegram' ? 'background-color: #1D2229; color: #ffffff;' : ($modal->button_1_type === 'whatsapp' ? 'background-color: #4CAF50; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
           "
           onmouseover="this.style.opacity='0.9'"
           onmouseout="this.style.opacity='1'">
            {{ $modal->button_1_text }}
        </a>
    @endif

    @if($modal->button_2_text && $modal->button_2_url)
        <a href="{{ $modal->button_2_type === 'telegram' ? 'https://t.me/' . ltrim($modal->button_2_url, '@') : ($modal->button_2_type === 'whatsapp' ? 'https://wa.me/' . preg_replace('/[^\d]/', '', $modal->button_2_url) : $modal->button_2_url) }}" 
           target="_blank"
           style="
               flex: 1;
               padding: 8px 12px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 400;
               font-size: 15px;
               text-align: center;
               transition: all 0.3s ease;
               display: block;
               {{ $modal->button_2_type === 'telegram' ? 'background-color: #1D2229; color: #ffffff;' : ($modal->button_2_type === 'whatsapp' ? 'background-color: #4CAF50; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
           "
           onmouseover="this.style.opacity='0.9'"
           onmouseout="this.style.opacity='1'">
            {{ $modal->button_2_text }}
        </a>
    @endif
</div>

