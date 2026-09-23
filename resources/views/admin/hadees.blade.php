<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hadees Admin Panel</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #0f4c3a;
    --primary-light: #1b6b55;
    --secondary: #c9a227;
    --white: #ffffff;
    --light-bg: #f6f8f7;
    --text-dark: #2d3748;
    --shadow: 0 12px 28px rgba(0,0,0,0.1);
    --radius: 14px;
}

body{
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(135deg,#eef5f2,#d7ebe3);
    padding:20px;
}

.container{max-width:1100px;margin:auto}

/* Header */
.header{text-align:center;margin-bottom:35px}
.header h1{
    font-size:2.6rem;
    color:var(--primary);
    display:flex;
    justify-content:center;
    gap:14px;
}
.header i{color:var(--secondary)}
.header p{color:#555}

/* Card */
.admin-card{
    background:var(--white);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
}
.card-header{
    background:linear-gradient(to right,var(--primary),var(--primary-light));
    color:#fff;
    padding:26px;
}
.card-header h2{
    display:flex;
    gap:10px;
    font-size:1.6rem;
}
.card-body{padding:30px}

/* Alert */
.alert{
    display:none;
    margin-bottom:20px;
    padding:18px;
    border-left:5px solid #16a34a;
    background:#dcfce7;
    color:#065f46;
    border-radius:10px;
}
.alert.show{display:flex;gap:10px}

/* Form */
.form-group{margin-bottom:25px}
label{
    font-weight:600;
    display:flex;
    gap:8px;
    margin-bottom:8px;
}
.textarea-container{
    border:2px solid #e2e8f0;
    border-radius:10px;
    overflow:hidden;
}
.textarea-container textarea{
    width:100%;
    border:none;
    background:var(--light-bg);
    padding:14px;
    resize:vertical;
    font-size:1rem;
}
.textarea-arabic textarea{
    direction:rtl;
    text-align:right;
    font-size:1.3rem;
    font-family:'Amiri','Segoe UI';
}
.char-count{
    font-size:0.8rem;
    padding:6px 12px;
    text-align:right;
    color:#6b7280;
}

/* Button */
.btn-submit{
    width:100%;
    background:linear-gradient(to right,var(--primary),var(--primary-light));
    color:#fff;
    border:none;
    padding:16px;
    border-radius:var(--radius);
    font-size:1.1rem;
    cursor:pointer;
    display:flex;
    justify-content:center;
    gap:10px;
}
.btn-submit:hover{opacity:.9}

/* Preview */
.preview-box{
    margin-top:40px;
    background:#fff;
    padding:26px;
    border-radius:var(--radius);
    border-left:6px solid var(--secondary);
    box-shadow:var(--shadow);
}
.preview-content{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:20px;
}
.preview-item{
    background:var(--light-bg);
    padding:18px;
    border-radius:10px;
}
.preview-arabic{
    direction:rtl;
    text-align:right;
    font-size:1.25rem;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
<h1><i class="fas fa-book-hadith"></i> Hadees Admin Panel</h1>
<p>Manage daily Ahadees with elegance</p>
</div>

<div class="alert" id="alert">
<i class="fas fa-check-circle"></i>
<div id="alert-message">Hadees saved successfully!</div>
</div>

<div class="admin-card">
<div class="card-header">
<h2><i class="fas fa-plus-circle"></i> Add New Hadees</h2>
</div>

<div class="card-body">
<form method="POST" action="/admin/hadees">
@csrf

<div class="form-group">
<label><i class="fas fa-language"></i> Arabic Hadees</label>
<div class="textarea-container textarea-arabic">
<textarea name="arabic" maxlength="1000" required></textarea>
<div class="char-count">Arabic text</div>
</div>
</div>

<div class="form-group">
<label><i class="fas fa-font"></i> Urdu Translation</label>
<div class="textarea-container">
<textarea name="urdu" maxlength="1500" required></textarea>
</div>
</div>

<div class="form-group">
<label><i class="fas fa-font"></i> English Translation</label>
<div class="textarea-container">
<textarea name="english" maxlength="1500" required></textarea>
</div>
</div>

<div class="form-group">
<label><i class="fas fa-book"></i> Reference (Book & Number)</label>
<div class="textarea-container">
<textarea name="reference" maxlength="200" required></textarea>
</div>
</div>

<button class="btn-submit">
<i class="fas fa-save"></i> Save Hadees
</button>

</form>
</div>
</div>

<div class="preview-box">
<h3><i class="fas fa-eye"></i> Live Preview</h3>
<div class="preview-content">
<div class="preview-item">
<h4>Arabic</h4>
<div class="preview-arabic">سيظهر نص الحديث هنا</div>
</div>
<div class="preview-item">
<h4>Urdu</h4>
<div>یہاں حدیث کا ترجمہ ظاہر ہوگا</div>
</div>
<div class="preview-item">
<h4>English</h4>
<div>Hadith translation will appear here</div>
</div>
<div class="preview-item">
<h4>Reference</h4>
<div>Book name & number</div>
</div>
</div>
</div>

</div>
</body>
</html>
