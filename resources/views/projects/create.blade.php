<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h1>إنشاء مشروع</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-control" required>
                    <option value="pending">pending</option>
                    <option value="in_progress">in_progress</option>
                    <option value="completed">completed</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">الأولوية</label>
                <select name="priority" class="form-control" required>
                    <option value="low">low</option>
                    <option value="medium">medium</option>
                    <option value="high">high</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">الميزانية</label>
                <input name="budget" type="number" value="{{ old('budget') }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">تاريخ البدء</label>
                <input name="start_date" type="date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">تاريخ الانتهاء</label>
                <input name="end_date" type="date" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">صور المشروع (يمكن رفع أكثر من صورة)</label>
            <input name="images[]" type="file" multiple class="form-control">
        </div>

        <button class="btn btn-success">حفظ</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</body>
</html>