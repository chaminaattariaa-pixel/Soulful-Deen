<?php

namespace App\Http\Controllers;

class GuidanceController extends Controller
{
    public function index()
    {
        // Guidance topics
        $topics = [
            ['slug' => 'worship',    'name' => 'Worship',       'icon' => '🕌', 'arabic' => 'العبادة',    'desc' => 'Salah, fasting, zakat, hajj and daily acts of worship.'],
            ['slug' => 'family',     'name' => 'Family Life',   'icon' => '👨‍👩‍👧', 'arabic' => 'الأسرة',   'desc' => 'Marriage, parenting and maintaining family ties.'],
            ['slug' => 'finance',    'name' => 'Finance',       'icon' => '💰', 'arabic' => 'المعاملات', 'desc' => 'Halal earnings, riba, zakat and Islamic finance.'],
            ['slug' => 'character',  'name' => 'Character',     'icon' => '🤝', 'arabic' => 'الأخلاق',    'desc' => 'Akhlaq, manners, honesty and dealings with others.'],
            ['slug' => 'knowledge',  'name' => 'Knowledge',     'icon' => '📚', 'arabic' => 'العلم',     'desc' => 'Seeking knowledge, learning and teaching.'],
            ['slug' => 'health',     'name' => 'Health',        'icon' => '🩺', 'arabic' => 'الصحة',     'desc' => 'Halal food, medicine and physical wellbeing.'],
            ['slug' => 'dawah',      'name' => 'Dawah',         'icon' => '📢', 'arabic' => 'الدعوة',    'desc' => 'Inviting others to Islam with wisdom and mercy.'],
            ['slug' => 'hereafter',  'name' => 'Hereafter',     'icon' => '🌌', 'arabic' => 'الآخرة',    'desc' => 'Death, grave, resurrection and the Day of Judgment.'],
        ];

        // Featured guidance articles
        $articles = [
            [
                'id'        => 1,
                'topic'     => 'worship',
                'title'     => 'How to Perfect Your Salah',
                'excerpt'   => 'Learn the conditions, pillars and Sunnahs of prayer to strengthen your connection with Allah.',
                'arabic'    => 'إِنَّ الصَّلَاةَ كَانَتْ عَلَى الْمُؤْمِنِينَ كِتَابًا مَّوْقُوتًا',
                'urdu'      => 'بے شک نماز مومنوں پر مقررہ وقتوں میں فرض کی گئی ہے۔',
                'english'   => 'Indeed, prayer has been decreed upon the believers at specified times.',
                'reference' => 'Quran 4:103',
                'readTime'  => '8 min',
            ],
            [
                'id'        => 2,
                'topic'     => 'family',
                'title'     => 'Rights of Parents in Islam',
                'excerpt'   => 'The elevated status of parents and how to fulfill their rights in daily life.',
                'arabic'    => 'وَبِالْوَالِدَيْنِ إِحْسَانًا',
                'urdu'      => 'اور والدین کے ساتھ حسن سلوک کرو۔',
                'english'   => 'And to parents, good treatment.',
                'reference' => 'Quran 17:23',
                'readTime'  => '6 min',
            ],
            [
                'id'        => 3,
                'topic'     => 'finance',
                'title'     => 'Understanding Riba in Modern Finance',
                'excerpt'   => 'What riba is, why it is prohibited, and how to avoid it in modern banking.',
                'arabic'    => 'وَأَحَلَّ اللَّهُ الْبَيْعَ وَحَرَّمَ الرِّبَا',
                'urdu'      => 'اللہ نے تجارت کو حلال اور سود کو حرام کیا ہے۔',
                'english'   => 'But Allah has permitted trade and has forbidden interest.',
                'reference' => 'Quran 2:275',
                'readTime'  => '10 min',
            ],
            [
                'id'        => 4,
                'topic'     => 'character',
                'title'     => 'The Best Character of the Prophet ﷺ',
                'excerpt'   => 'Examples from the Sunnah of mercy, patience, honesty and humility.',
                'arabic'    => 'وَإِنَّكَ لَعَلَىٰ خُلُقٍ عَظِيمٍ',
                'urdu'      => 'اور بے شک آپ عظیم اخلاق پر فائز ہیں۔',
                'english'   => 'And indeed, you are of a great moral character.',
                'reference' => 'Quran 68:4',
                'readTime'  => '7 min',
            ],
            [
                'id'        => 5,
                'topic'     => 'knowledge',
                'title'     => 'The Virtue of Seeking Knowledge',
                'excerpt'   => 'Why the first command revealed was "Read" and how knowledge elevates the believer.',
                'arabic'    => 'اقْرَأْ بِاسْمِ رَبِّكَ الَّذِي خَلَقَ',
                'urdu'      => 'پڑھو اپنے رب کے نام سے جس نے پیدا کیا۔',
                'english'   => 'Read in the name of your Lord who created.',
                'reference' => 'Quran 96:1',
                'readTime'  => '5 min',
            ],
            [
                'id'        => 6,
                'topic'     => 'hereafter',
                'title'     => 'Preparing for the Day of Judgment',
                'excerpt'   => 'A reminder on the accountability of every deed and how to prepare for the Hereafter.',
                'arabic'    => 'فَمَن يَعْمَلْ مِثْقَالَ ذَرَّةٍ خَيْرًا يَرَهُ',
                'urdu'      => 'پس جس نے ذرہ برابر نیکی کی وہ اسے دیکھ لے گا۔',
                'english'   => 'So whoever does an atom\'s weight of good will see it.',
                'reference' => 'Quran 99:7',
                'readTime'  => '9 min',
            ],
            [
                'id'        => 7,
                'topic'     => 'health',
                'title'     => 'Maintaining Physical and Mental Health in Islam',
                'excerpt'   => 'The importance of a balanced lifestyle, diet, exercise and mental wellbeing.',
                'arabic'    => 'وَكُلُوا وَاشْرَبُوا وَلَا تُسْرِفُوا',
                'urdu'      => 'کھاؤ اور پیو اور حد سے تجاوز نہ کرو۔',
                'english'   => 'Eat and drink but do not be excessive.',
                'reference' => 'Quran 7:31',
                'readTime'  => '8 min',
            ],
        ];

        // Common Q&A
        $faqs = [
            [
                'q' => 'Is it permissible to combine prayers while travelling?',
                'a' => 'Yes. Combining Dhuhr with Asr, and Maghrib with Isha, is permitted while travelling according to the majority of scholars, following the practice of the Prophet ﷺ. Combine them at the time of either prayer, though combining at the time of the first is safer.',
                'ref' => 'Muslim 705, Bukhari 1108',
            ],
            [
                'q' => 'What is the ruling on music in Islam?',
                'a' => 'Scholars differ on the details. The majority hold that musical instruments used for entertainment and idle diversion are prohibited, based on authentic hadith. However, permissible exceptions exist, such as the duff at weddings and battle chants. Consulting a qualified scholar for a specific case is recommended.',
                'ref' => 'Bukhari 5590',
            ],
            [
                'q' => 'Can I pay zakat to my poor relatives?',
                'a' => 'Yes. In fact, giving zakat to eligible relatives carries a double reward — one for zakat and one for maintaining family ties — provided they are not among those you are already obligated to support (e.g. your parents, spouse, or children).',
                'ref' => 'Bukhari 1466',
            ],
            [
                'q' => 'What should I do if I miss a fast in Ramadan?',
                'a' => 'If you missed a fast due to illness, travel, or menstruation, you must make it up later. If you broke it deliberately without a valid excuse, you must make it up and offer expiation (kaffarah) — fasting two consecutive months or feeding sixty poor people.',
                'ref' => 'Bukhari 1934',
            ],
            [
                'q' => 'How do I repent from a major sin?',
                'a' => 'Sincere repentance has three conditions: (1) stop the sin immediately, (2) feel deep regret, and (3) firmly resolve never to return to it. If the sin involves someone else\'s rights, a fourth condition is to restore their right or seek their forgiveness.',
                'ref' => 'Riyad as-Salihin 12',
            ],
        ];

        return view('guidance.index', compact('topics', 'articles', 'faqs'));
    }
}