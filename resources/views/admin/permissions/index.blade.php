<!doctype html><html><body>
<h3>الصلاحيات</h3>
<form method="POST" action="{{ route('admin.permissions.store') }}">
    @csrf
    <input name="name" placeholder="اسم الصلاحية" required>
    <button>إضافة</button>
</form>

<table>
@foreach($permissions as $p)
<tr>
  <td>{{ $p->name }}</td>
  <td>
    <form method="POST" action="{{ route('admin.permissions.destroy', $p) }}">
      @csrf @method('DELETE')
      <button onclick="return confirm('حذف؟')">حذف</button>
    </form>
  </td>
</tr>
@endforeach
</table>

{{ $permissions->links() }}
</body></html>

<?php
if ($user->can('create projects')) { ... }
$user->givePermissionTo('edit projects');
$user->assignRole('admin');