<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h1>المشاريع</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">إنشاء مشروع جديد</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($projects as $project)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($project->images->first())
                        <img src="{{ Storage::disk('public')->url($project->images->first()->path) }}" class="card-img-top" alt="">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">تعديل</a>
                        <form method="POST" action="{{ route('projects.destroy', $project) }}" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('حذف؟')">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $projects->links() }}
</div>
</body>
</html>