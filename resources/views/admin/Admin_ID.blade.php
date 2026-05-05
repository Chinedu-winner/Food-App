<form method="POST" action="{{ route('admin.update.id', $admin->id) }}">
    @csrf

    <h3>Update Admin ID for {{ $admin->name }}</h3>

    <input type="text" name="admin_id" value="{{ $admin->admin_id }}" required>

    <button type="submit">Update ID</button>
</form>