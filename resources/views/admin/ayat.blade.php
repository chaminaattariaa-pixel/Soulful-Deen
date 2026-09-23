<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayat Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0b5d4b;
            --primary-light: #0d7a64;
            --secondary: #d4af37;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text-dark: #2d3748;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e6f2 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text-dark);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease;
        }

        .header h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .header h1 i {
            color: var(--secondary);
            animation: float 3s ease-in-out infinite;
        }

        /* Admin Card */
        .admin-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
            animation: slideUp 0.6s ease;
        }

        .card-header {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: white;
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }

        .card-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 2s infinite;
        }

        .card-header h2 {
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-body {
            padding: 30px;
        }

        /* Alert */
        .alert {
            padding: 18px 20px;
            border-radius: var(--radius);
            margin-bottom: 25px;
            display: none;
            align-items: center;
            gap: 15px;
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
            animation: slideInRight 0.5s ease;
        }

        .alert.show {
            display: flex;
        }

        /* Form */
        .form-group {
            margin-bottom: 25px;
            animation: fadeIn 0.5s ease;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-group label i {
            color: var(--primary);
        }

        .textarea-container {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .textarea-container:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(11, 93, 75, 0.1);
            transform: translateY(-2px);
        }

        .textarea-container textarea {
            width: 100%;
            padding: 15px;
            border: none;
            outline: none;
            font-size: 1rem;
            resize: vertical;
            min-height: 120px;
            background: var(--light-bg);
            transition: all 0.3s ease;
        }

        .textarea-arabic textarea {
            font-family: 'Segoe UI', Tahoma, 'Times New Roman', Times, serif;
            font-size: 1.2rem;
            text-align: right;
            direction: rtl;
        }

        .char-count {
            text-align: right;
            font-size: 0.85rem;
            color: #718096;
            padding: 8px 15px;
            background: rgba(0, 0, 0, 0.02);
            border-top: 1px solid #e2e8f0;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 18px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(11, 93, 75, 0.2);
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        /* Preview */
        .preview-box {
            background: var(--white);
            border-radius: var(--radius);
            padding: 25px;
            margin-top: 40px;
            border-left: 5px solid var(--secondary);
            box-shadow: var(--shadow);
            animation: slideUp 0.6s ease 0.2s both;
        }

        .preview-box h3 {
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .preview-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .preview-item {
            background: var(--light-bg);
            padding: 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .preview-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .preview-item h4 {
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .preview-text {
            line-height: 1.6;
            min-height: 100px;
        }

        .preview-arabic {
            font-size: 1.2rem;
            text-align: right;
            direction: rtl;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .preview-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-quran"></i> Ayat Admin Panel</h1>
            <p>Manage daily ayat with beautiful animations</p>
        </div>

        <div class="alert" id="alert">
            <i class="fas fa-check-circle"></i>
            <div id="alert-message">Ayat saved successfully!</div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h2><i class="fas fa-plus-circle"></i> Add New Ayat</h2>
            </div>
            
            <div class="card-body">
                {{-- <form id="ayatForm"> --}}
                    <form id="ayatForm" method="POST" action="/admin/ayat">
                    @csrf

                    <div class="form-group">
                        <label for="arabic"><i class="fas fa-language"></i> Arabic Ayat</label>
                        <div class="textarea-container textarea-arabic">
                            <textarea id="arabic" name="arabic" placeholder="أدخل الآية الكريمة هنا..." maxlength="1000" required></textarea>
                            <div class="char-count"><span id="arabic-count">0</span>/1000</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="urdu"><i class="fas fa-font"></i> Urdu Translation</label>
                        <div class="textarea-container">
                            <textarea id="urdu" name="urdu" placeholder="اردو ترجمہ درج کریں..." maxlength="1500" required></textarea>
                            <div class="char-count"><span id="urdu-count">0</span>/1500</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="english"><i class="fas fa-font"></i> English Translation</label>
                        <div class="textarea-container">
                            <textarea id="english" name="english" placeholder="Enter English translation..." maxlength="1500" required></textarea>
                            <div class="char-count"><span id="english-count">0</span>/1500</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reference"><i class="fas fa-book"></i> Reference</label>
                        <div class="textarea-container">
                            <textarea id="reference" name="reference" placeholder="refer" maxlength="200" required></textarea>
                            <div class="char-count"><span id="reference-count">0</span>/200</div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Save Ayat
                    </button>
                </form>
            </div>
        </div>

        <div class="preview-box">
            <h3><i class="fas fa-eye"></i> Live Preview</h3>
            <div class="preview-content">
                <div class="preview-item">
                    <h4><i class="fas fa-language"></i> Arabic</h4>
                    <div class="preview-text preview-arabic" id="preview-arabic">سيظهر النص هنا...</div>
                </div>
                <div class="preview-item">
                    <h4><i class="fas fa-font"></i> Urdu</h4>
                    <div class="preview-text" id="preview-urdu">متن یہاں ظاہر ہوگا...</div>
                </div>
                <div class="preview-item">
                    <h4><i class="fas fa-font"></i> English</h4>
                    <div class="preview-text" id="preview-english">Text will appear here...</div>
                </div>
                <div class="preview-item">
                    <h4><i class="fas fa-book"></i> Reference</h4>
                    <div class="preview-text" id="preview-reference">Reference will appear here...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const arabic = document.getElementById('arabic');
            const urdu = document.getElementById('urdu');
            const english = document.getElementById('english');
            const reference = document.getElementById('reference');
            const form = document.getElementById('ayatForm');
            const submitBtn = form.querySelector('.btn-submit');
            const alertBox = document.getElementById('alert');
            const alertMsg = document.getElementById('alert-message');

            // Initialize counters
            updateCounter(arabic, 'arabic-count');
            updateCounter(urdu, 'urdu-count');
            updateCounter(english, 'english-count');
            updateCounter(reference, 'reference-count');

            // Real-time preview
            arabic.addEventListener('input', function() {
                updateCounter(this, 'arabic-count');
                document.getElementById('preview-arabic').textContent = this.value || 'سيظهر النص هنا...';
            });

            urdu.addEventListener('input', function() {
                updateCounter(this, 'urdu-count');
                document.getElementById('preview-urdu').textContent = this.value || 'متن یہاں ظاہر ہوگا...';
            });

            english.addEventListener('input', function() {
                updateCounter(this, 'english-count');
                document.getElementById('preview-english').textContent = this.value || 'Text will appear here...';
            });

            reference.addEventListener('input', function() {
                updateCounter(this, 'reference-count');
                document.getElementById('preview-reference').textContent = this.value || 'Reference will appear here...';
            });

            // // Form submission
            // form.addEventListener('submit', function(e) {
            //     e.preventDefault();
                
            //     // Validation
            //     if (!arabic.value.trim() || !urdu.value.trim() || !english.value.trim() || !reference.value.trim()) {
            //         showAlert('Please fill all fields', 'warning');
            //         return;
            //     }

            //     // Show loading state
            //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            //     submitBtn.disabled = true;

            //     // Simulate API call
            //     setTimeout(() => {
            //         // Show success
            //         showAlert('Ayat saved successfully!', 'success');
                    
            //         // Reset form
            //         form.reset();
                    
            //         // Reset preview
            //         document.getElementById('preview-arabic').textContent = 'سيظهر النص هنا...';
            //         document.getElementById('preview-urdu').textContent = 'متن یہاں ظاہر ہوگا...';
            //         document.getElementById('preview-english').textContent = 'Text will appear here...';
            //         document.getElementById('preview-reference').textContent = 'Reference will appear here...';
                    
            //         // Reset counters
            //         updateCounter(arabic, 'arabic-count');
            //         updateCounter(urdu, 'urdu-count');
            //         updateCounter(english, 'english-count');
            //         updateCounter(reference, 'reference-count');
                    
            //         // Reset button
            //         submitBtn.innerHTML = '<i class="fas fa-save"></i> Save Ayat';
            //         submitBtn.disabled = false;
            //     }, 1500);
            // });

            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
            });


            // Functions
            function updateCounter(textarea, counterId) {
                const counter = document.getElementById(counterId);
                const count = textarea.value.length;
                const max = parseInt(textarea.getAttribute('maxlength'));
                
                counter.textContent = count;
                
                // Color coding
                if (count > max * 0.9) {
                    counter.style.color = '#e53e3e';
                } else if (count > max * 0.75) {
                    counter.style.color = '#d69e2e';
                } else {
                    counter.style.color = '#718096';
                }
            }

            function showAlert(message, type) {
                alertMsg.textContent = message;
                
                if (type === 'success') {
                    alertBox.style.background = '#d1fae5';
                    alertBox.style.color = '#065f46';
                    alertBox.style.borderLeftColor = '#10b981';
                } else {
                    alertBox.style.background = '#fef3c7';
                    alertBox.style.color = '#92400e';
                    alertBox.style.borderLeftColor = '#f59e0b';
                }
                
                alertBox.classList.add('show');
                
                // Auto hide after 3 seconds
                setTimeout(() => {
                    alertBox.classList.remove('show');
                }, 3000);
            }

            // Auto resize textareas
            function autoResize(textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }

            [arabic, urdu, english, reference].forEach(ta => {
                ta.addEventListener('input', () => autoResize(ta));
                autoResize(ta);
            });
        });
    </script>
</body>
</html>