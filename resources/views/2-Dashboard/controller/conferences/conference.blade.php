@extends('4-layout.backend');
@section('title', 'Controller Conferences')
@section('content')

    <section id="coference-Controller">

        <div class="card shadow-sm p-4 mb-4 bg-white rounded">

            <div class="d-flex justify-content-between align-items-center my-3">
                <h4 class="text-dark" style="font-size: 13px">Conferences Management</h4>
                <div>
                    <button class="btn bg text mx-1" onclick="filterconferences('all')" style="font-size: 12px">All
                        <span class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
                    </button>
                    <button class="btn bg text mx-1" onclick="filterconferences('ongoing')" style="font-size: 12px">ongoing
                        <span class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
                    </button>
                    </button>
                    <button class="btn bg text mx-1" onclick="filterconferences('completed')"
                        style="font-size: 12px">completed
                        <span class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
                    </button>
                    <button class="btn bg text mx-1" onclick="filterconferences('upcoming')"
                        style="font-size: 12px">upcoming
                        <span class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
                    </button>
                    </button>
                </div>
            </div>

            <div class="add-conferences d-flex justify-content-end">
                <a href="{{ route('controller.create_conference') }}" class="btn fs-12 btn-success mx-1 text"><i
                        class="fa-solid fa-plus"></i> Add
                    conference</a>
            </div>

            <div class="d-flex justify-content-end mt-3" style="font-size: 12px">
                {{ $Conferences->links('pagination::bootstrap-5') }}
            </div>


        </div>

        <!-- Paper Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead style="font-size: 12px">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Deadline</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px">
                    @if ($Conferences->isNotEmpty())
                                @foreach ($Conferences as $Conference)
                                            <tr class="conferences-row" data-status="{{ $Conference->status }}">
                                                <td class="p-3">{{ $Conference->id }}</td>
                                                <td class="p-3">{{ Str::limit($Conference->title, 20, '....') }}</td>

                                                <!-- Description -->
                                                <td x-data="{open: false}" class="p-3">
                                                    <span x-on:click="open = !open" class="description">
                                                        {{ Str::limit($Conference->description, 20, '....') }}
                                                    </span>
                                                    <span x-show="open">
                                                        {{ $Conference->description }}
                                                    </span>
                                                </td>

                                                <!-- Status -->
                                                <td class="text-center p-3">
                                                    <span @class([
                                                        'badge bg-opacity-10 text-primary px-3 py-2 rounded-pill',
                                                        'bg text' => $Conference->status == 'upcoming',
                                                        'bg-pr text' => $Conference->status == 'ongoing',
                                                        'bg-dark' => $Conference->status == 'completed',
                                                    ])>
                                                        {{ $Conference->status }}
                                                    </span>
                                                </td>

                                                <!-- Dates -->
                                                <td class="p-3">{{ $Conference->start_date }}</td>
                                                <td class="p-3">{{ $Conference->end_date }}</td>
                                                <td class="p-3">{{ $Conference->registration_deadline }}</td>

                                                <!-- Location -->
                                                <td class="p-3">{{ $Conference->location }}</td>

                                                <!-- Action Buttons -->
                                                <td>
                                                    <a href="{{ route('controller.view_conference', $Conference->id) }}"
                                                        class="btn bg text p-1 btn-sm" style="font-size: 11px">
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </a>
                                                    <form id="delete-form-{{ $Conference->id }}" class="p-1"
                                                        action="{{ route('controller.destroy_conference', $Conference->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn  text p-1 btn-s btn-danger" style="font-size: 10px"
                                                            onclick="confirmDelete({{ $Conference->id }})"><i class="fa-solid fa-trash"></i>
                                                            Delete</button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(conferenceId) {
                                                            if (confirm("Are you sure you want to delete this conference? This action cannot be undone!")) {
                                                                document.getElementById('delete-form-' + conferenceId).submit();
                                                            }
                                                        }
                                                    </script>

                                                </td>
                                            </tr>
                                @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="p-5 text-center">No Conference found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div id="no-match">No match found</div>

    </section>

    </div>


@endsection