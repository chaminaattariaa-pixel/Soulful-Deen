@foreach($ayahs as $ayah)
    <div class="ayah">
        <!-- Arabic -->
        <div class="arabic">
            {{ $ayah->arabic ?? $ayah->arabic_text ?? '' }}
        </div>

        <!-- Translation -->
        <div class="translation">
            <div class="english">
                {{ $ayah->english ?? $ayah->english_text ?? 'English translation not available' }}
            </div>

            <div class="urdu">
                {{ $ayah->urdu ?? $ayah->urdu_text ?? 'اردو ترجمہ دستیاب نہیں' }}
            </div>
        </div>

        <!-- Footer -->
        <div class="ayah-footer">
            <div class="ayah-number">
                Ayah {{ $ayah->ayah_number ?? $ayah->number ?? 'N/A' }}
            </div>
            <div class="page-number">
                Page {{ $ayah->page ?? 'N/A' }} | Juz {{ $ayah->juz ?? 'N/A' }}
            </div>
        </div>
    </div>
@endforeach