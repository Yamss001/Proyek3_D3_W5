
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Role Management Demo</title>
</head>
<body>
    <h1>Role Management Demo</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <p>{{ $errors->first('role') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Role saat ini</th>
            <th>Aksi</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->nama_lengkap }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form
                        action="{{ route('admin.users.role.update', $user->getKey()) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <select name="role">
                            <option value="customer">customer</option>
                            <option value="staff">staff</option>
                        </select>

                        <button type="submit">Ubah Role</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
