<?php

namespace App\Http\Controllers;

class DuaController extends Controller
{
    public function index()
    {
        // Dua categories
        $categories = [
            ['slug' => 'morning',    'name' => 'Morning',       'icon' => '🌅', 'arabic' => 'الصباح'],
            ['slug' => 'evening',    'name' => 'Evening',       'icon' => '🌆', 'arabic' => 'المساء'],
            ['slug' => 'sleep',      'name' => 'Sleep',         'icon' => '🌙', 'arabic' => 'النوم'],
            ['slug' => 'waking',     'name' => 'Waking Up',     'icon' => '☀️', 'arabic' => 'الاستيقاظ'],
            ['slug' => 'eating',     'name' => 'Eating',        'icon' => '🍽️', 'arabic' => 'الطعام'],
            ['slug' => 'travel',     'name' => 'Travel',        'icon' => '✈️', 'arabic' => 'السفر'],
            ['slug' => 'protection', 'name' => 'Protection',    'icon' => '🛡️', 'arabic' => 'الحماية'],
            ['slug' => 'forgiveness','name' => 'Forgiveness',   'icon' => '🤲', 'arabic' => 'الاستغفار'],
            ['slug' => 'distress',   'name' => 'Distress',      'icon' => '💧', 'arabic' => 'الكرب'],
            ['slug' => 'gratitude',  'name' => 'Gratitude',     'icon' => '✨', 'arabic' => 'الشكر'],
            ['slug' => 'prayer',     'name' => 'Prayer',        'icon' => '🕌', 'arabic' => 'الصلاة'],
            ['slug' => 'general',    'name' => 'General',       'icon' => '📿', 'arabic' => 'عام'],
        ];

        // Duas collection
        $duas = [
            [
                'id'       => 1,
                'category' => 'morning',
                'title'    => 'Dua for Morning',
                'arabic'   => 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلَّهِ، وَالْحَمْدُ لِلَّهِ، لاَ إِلَـهَ إِلاَّ اللهُ وَحْدَهُ لاَ شَرِيكَ لَهُ',
                'urdu'     => 'ہم نے صبح کی اور تمام بادشاہت اللہ کے لیے صبح ہوئی، اور تمام تعریفیں اللہ کے لیے ہیں، اللہ کے سوا کوئی معبود نہیں وہ اکیلا ہے اس کا کوئی شریک نہیں۔',
                'english'  => 'We have entered the morning and the dominion belongs to Allah, and all praise is for Allah. There is no deity except Allah, alone, without any partner.',
                'reference'=> 'Muslim 4:2091',
            ],
            [
                'id'       => 2,
                'category' => 'evening',
                'title'    => 'Dua for Evening',
                'arabic'   => 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ، وَالْحَمْدُ لِلَّهِ، لاَ إِلَـهَ إِلاَّ اللهُ وَحْدَهُ لاَ شَرِيكَ لَهُ',
                'urdu'     => 'ہم نے شام کی اور تمام بادشاہت اللہ کے لیے شام ہوئی، اور تمام تعریفیں اللہ کے لیے ہیں، اللہ کے سوا کوئی معبود نہیں وہ اکیلا ہے اس کا کوئی شریک نہیں۔',
                'english'  => 'We have entered the evening and the dominion belongs to Allah, and all praise is for Allah. There is no deity except Allah, alone, without any partner.',
                'reference'=> 'Muslim 4:2091',
            ],
            [
                'id'       => 3,
                'category' => 'sleep',
                'title'    => 'Dua Before Sleeping',
                'arabic'   => 'بِاسْمِكَ اللَّهُمَّ أَمُوتُ وَأَحْيَا',
                'urdu'     => 'اے اللہ! تیرے نام کے ساتھ میں مرتا ہوں اور جیتا ہوں۔',
                'english'  => 'In Your name, O Allah, I die and I live.',
                'reference'=> 'Bukhari 6324',
            ],
            [
                'id'       => 4,
                'category' => 'waking',
                'title'    => 'Dua Upon Waking Up',
                'arabic'   => 'الْحَمْدُ لِلَّهِ الَّذِي أَحْيَانَا بَعْدَ مَا أَمَاتَنَا وَإِلَيْهِ النُّشُورُ',
                'urdu'     => 'تمام تعریفیں اللہ کے لیے ہیں جس نے ہمیں موت کے بعد زندگی بخشی اور اسی کی طرف لوٹنا ہے۔',
                'english'  => 'All praise is for Allah who gave us life after having taken it from us, and unto Him is the resurrection.',
                'reference'=> 'Bukhari 6312',
            ],
            [
                'id'       => 5,
                'category' => 'eating',
                'title'    => 'Dua Before Eating',
                'arabic'   => 'بِسْمِ اللَّهِ وَعَلَى بَرَكَةِ اللَّهِ',
                'urdu'     => 'اللہ کے نام سے اور اللہ کی برکت پر (کھانا شروع کرتا ہوں)۔',
                'english'  => 'In the name of Allah and with the blessings of Allah.',
                'reference'=> 'Abu Dawud 3767',
            ],
            [
                'id'       => 6,
                'category' => 'eating',
                'title'    => 'Dua After Eating',
                'arabic'   => 'الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِينَ',
                'urdu'     => 'تمام تعریفیں اللہ کے لیے ہیں جس نے ہمیں کھلایا، پلایا اور مسلمان بنایا۔',
                'english'  => 'All praise is for Allah who fed us, gave us drink, and made us Muslims.',
                'reference'=> 'Abu Dawud 3850',
            ],
            [
                'id'       => 7,
                'category' => 'travel',
                'title'    => 'Dua for Travel',
                'arabic'   => 'سُبْحَانَ الَّذِي سَخَّرَ لَنَا هَذَا وَمَا كُنَّا لَهُ مُقْرِنِينَ وَإِنَّا إِلَى رَبِّنَا لَمُنْقَلِبُونَ',
                'urdu'     => 'پاک ہے وہ ذات جس نے اس سواری کو ہمارے تابع کیا حالانکہ ہم اسے قابو میں نہیں کر سکتے تھے، اور بے شک ہم اپنے رب کی طرف لوٹنے والے ہیں۔',
                'english'  => 'Glory be to Him who has subjected this to us, and we could never have it (by our efforts). And verily, to Our Lord we indeed are to return.',
                'reference'=> 'Muslim 1342',
            ],
            [
                'id'       => 8,
                'category' => 'protection',
                'title'    => 'Dua for Protection',
                'arabic'   => 'أَعُوذُ بِكَلِمَاتِ اللَّهِ التَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ',
                'urdu'     => 'میں اللہ کے مکمل کلمات کی پناہ مانگتا ہوں ہر اس چیز کے شر سے جو اس نے پیدا کی۔',
                'english'  => 'I seek refuge in the perfect words of Allah from the evil of what He has created.',
                'reference'=> 'Muslim 2708',
            ],
            [
                'id'       => 9,
                'category' => 'forgiveness',
                'title'    => 'Sayyidul Istighfar',
                'arabic'   => 'اللَّهُمَّ أَنْتَ رَبِّي لاَ إِلَهَ إِلاَّ أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ',
                'urdu'     => 'اے اللہ! تو میرا رب ہے، تیرے سوا کوئی معبود نہیں، تو نے مجھے پیدا کیا، میں تیرا بندہ ہوں، میں اپنی طاقت کے مطابق تیرے عہد اور وعدے پر قائم ہوں۔',
                'english'  => 'O Allah, You are my Lord, none has the right to be worshipped except You. You created me and I am Your servant. I abide by Your covenant and promise as best as I can.',
                'reference'=> 'Bukhari 6306',
            ],
            [
                'id'       => 10,
                'category' => 'distress',
                'title'    => 'Dua in Distress',
                'arabic'   => 'لاَ إِلَهَ إِلاَّ اللَّهُ الْعَظِيمُ الْحَلِيمُ، لاَ إِلَهَ إِلاَّ اللَّهُ رَبُّ الْعَرْشِ الْعَظِيمِ',
                'urdu'     => 'اللہ کے سوا کوئی معبود نہیں جو عظیم اور بردبار ہے، اللہ کے سوا کوئی معبود نہیں جو عرش عظیم کا رب ہے۔',
                'english'  => 'There is no deity except Allah, the Mighty, the Forbearing. There is no deity except Allah, Lord of the Magnificent Throne.',
                'reference'=> 'Bukhari 6345',
            ],
            [
                'id'       => 11,
                'category' => 'gratitude',
                'title'    => 'Dua of Gratitude',
                'arabic'   => 'اللَّهُمَّ أَعِنِّي عَلَى ذِكْرِكَ وَشُكْرِكَ وَحُسْنِ عِبَادَتِكَ',
                'urdu'     => 'اے اللہ! میری مدد فرما اپنے ذکر، شکر اور اچھی عبادت پر۔',
                'english'  => 'O Allah, help me to remember You, to thank You, and to worship You in the best manner.',
                'reference'=> 'Abu Dawud 1522',
            ],
            [
                'id'       => 12,
                'category' => 'prayer',
                'title'    => 'Dua After Prayer',
                'arabic'   => 'اللَّهُمَّ أَنْتَ السَّلاَمُ وَمِنْكَ السَّلاَمُ، تَبَارَكْتَ يَا ذَا الْجَلاَلِ وَالإِكْرَامِ',
                'urdu'     => 'اے اللہ! تو سلام ہے اور تجھ سے سلام ہے، تو بابرکت ہے اے بزرگی اور عزت والے۔',
                'english'  => 'O Allah, You are As-Salam (Peace) and from You is all peace. Blessed are You, O Owner of majesty and honor.',
                'reference'=> 'Muslim 591',
            ],
            [
                'id'       => 13,
                'category' => 'general',
                'title'    => 'Dua for Good in Both Worlds',
                'arabic'   => 'رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ',
                'urdu'     => 'اے ہمارے رب! ہمیں دنیا میں بھی بھلائی دے اور آخرت میں بھی بھلائی دے اور ہمیں آگ کے عذاب سے بچا۔',
                'english'  => 'Our Lord, give us good in this world and good in the Hereafter, and protect us from the punishment of the Fire.',
                'reference'=> 'Quran 2:201',
            ],
            [
                'id'       => 14,
                'category' => 'morning',
                'title'    => 'Morning Remembrance',
                'arabic'   => 'اللَّهُمَّ بِكَ أَصْبَحْنَا، وَبِكَ أَمْسَيْنَا، وَبِكَ نَحْيَا، وَبِكَ نَمُوتُ، وَإِلَيْكَ النُّشُورُ',
                'urdu'     => 'اے اللہ! تیری مدد سے ہم نے صبح کی اور تیری مدد سے شام کی، تیری مدد سے جیتے ہیں اور تیری مدد سے مرتے ہیں اور تیری ہی طرف لوٹنا ہے۔',
                'english'  => 'O Allah, by You we enter the morning and by You we enter the evening, by You we live and by You we die, and to You is the final return.',
                'reference'=> 'Tirmidhi 3391',
            ],
            [
                'id'       => 15,
                'category' => 'protection',
                'title'    => 'Ayat al-Kursi',
                'arabic'   => 'اللَّهُ لاَ إِلَهَ إِلاَّ هُوَ الْحَيُّ الْقَيُّومُ، لاَ تَأْخُذُهُ سِنَةٌ وَلاَ نَوْمٌ',
                'urdu'     => 'اللہ، اس کے سوا کوئی معبود نہیں، وہ زندہ اور قائم ہے، اسے نہ اونگھ آتی ہے نہ نیند۔',
                'english'  => 'Allah - there is no deity except Him, the Ever-Living, the Sustainer of existence. Neither drowsiness overtakes Him nor sleep.',
                'reference'=> 'Quran 2:255',
            ],
        ];

        return view('duas.index', compact('categories', 'duas'));
    }
}