<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>إنشاء حساب</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container" style="max-width:520px">
    <h3 class="mb-3">إنشاء حساب جديد</h3>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input name="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input name="email" value="{{ old('email') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input name="password" type="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">تأكيد كلمة المرور</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>
        <button class="btn btn-success">إنشاء</button>
        <a href="{{ route('login') }}" class="btn btn-link">لديك حساب؟ تسجيل دخول</a>
    </form>

    @auth
        <div class="mt-3">
            <p>مرحباً {{ auth()->user()->name }}</p>
        </div>
    @endauth

    @guest
        <div class="mt-3">
            <a href="{{ route('login') }}">تسجيل الدخول</a>
        </div>
    @endguest
</div>
</body>
</html>