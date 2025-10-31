@props(['modal'])

<div class="modal-buttons" style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
    @if($modal->button_1_text && $modal->button_1_url)
        <a href="{{ $modal->button_1_type === 'telegram' ? 'https://t.me/' . ltrim($modal->button_1_url, '@') : ($modal->button_1_type === 'whatsapp' ? 'https://wa.me/' . preg_replace('/[^\d]/', '', $modal->button_1_url) : $modal->button_1_url) }}" 
           target="_blank"
           style="
               padding: 12px 24px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 600;
               font-size: 14px;
               transition: all 0.3s ease;
               {{ $modal->button_1_type === 'telegram' ? 'background-color: #0088cc; color: #ffffff;' : ($modal->button_1_type === 'whatsapp' ? 'background-color: #25D366; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
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
               padding: 12px 24px;
               border-radius: 8px;
               text-decoration: none;
               font-weight: 600;
               font-size: 14px;
               transition: all 0.3s ease;
               {{ $modal->button_2_type === 'telegram' ? 'background-color: #0088cc; color: #ffffff;' : ($modal->button_2_type === 'whatsapp' ? 'background-color: #25D366; color: #ffffff;' : 'background-color: #667eea; color: #ffffff;') }}
           "
           onmouseover="this.style.opacity='0.9'"
           onmouseout="this.style.opacity='1'">
            {{ $modal->button_2_text }}
        </a>
    @endif
</div>

