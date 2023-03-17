@props(['countries'])

<div class="border border-gray-300 sm:rounded-md w-full">
    <div class="bg-gray-100 p-3 px-5 border-b border-gray-300">
        List of countries
    </div>
    <table class="table w-11/12 mx-auto mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">ISO</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $key => $country)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->iso }}</td>
                    <td class="w-0">
                        <a 
                            href="{{ url("/country/$country->id/edit") }}" 
                            class="inline-flex bg-blue-500 rounded-md font-semibold text-sm text-white px-3 py-2"
                            >
                            Edit
                        </a>
                    </td>
                    <td class="w-0">
                        <form method="POST" action="{{ route('country.destroy', $country->id) }}">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="inline-flex bg-red-500 rounded-md font-semibold text-sm text-white px-3 py-2"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>