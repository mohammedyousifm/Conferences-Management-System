<div wire:poll.5s> <!-- تحديث تلقائي كل 5 ثواني -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @if ($users && count($users) > 0)
                @foreach ($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No users found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
